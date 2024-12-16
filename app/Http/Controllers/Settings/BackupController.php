<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Log;

class BackupController extends Controller
{

    private function getBackups()
    {
        try {
        } catch (\Exception $e) {
            Log::error("Firebase getting error: " . $e->getMessage());
            return false;
        }
    }
    //
    public function index()
    {
        try {
            // Initialize Firebase Storage
        $firebase = (new Factory)->withServiceAccount((base_path() . '/app/reg-archive-firebase-adminsdk-140mx-e5a5981a75.json'))->withDefaultStorageBucket('reg-archive.firebasestorage.app');
        $storage = $firebase->createStorage();
        $bucket = $storage->getBucket();

        // List all objects in the "backups" folder
        $objects = $bucket->objects(['prefix' => 'backups/']);
        $backupFiles = [];

        foreach ($objects as $object) {
            // Exclude folder-like entries
            if ($object->name() === 'backups/') {
                continue;
            }

            // Retrieve metadata
            $backupFiles[] = [
                'name' => $object->name(),
                'size' => $object->info()['size'],
                'updated' => $object->info()['updated'],
                'download_url' => $object->signedUrl(new \DateTime('1 hour')), // Temporary signed URL
            ];
        }

        // Sort backups by updated date in descending order
        usort($backupFiles, function ($a, $b) {
            return strtotime($b['updated']) - strtotime($a['updated']);
        });

        // Return the list of backups to the view
        return view('settings.backup.index', compact('backupFiles'));
        } catch (\Exception $e) {
            return view('settings.backup.index')->with('error_message', value: 'Backup fetch failed: ' . $e->getMessage());
        }

    }

    public function generateBackup(Request $request)
    {
        try {
            // Get all table names
            $tables = collect(DB::select('SHOW TABLES'))->map(function ($table) {
                return array_values((array) $table)[0];
            });
            $backupData = [];

            // Retrieve data from each table
            foreach ($tables as $table) {
                // Skip the "users" table
                if ($table === 'users') {
                    continue;
                }

                $backupData[$table] = DB::table($table)->get()->toArray();
            }

            // Convert the data to JSON format
            $filenameBase = "backup_database_" . now()->format('Ymd_His');
            $fileName = $filenameBase . '.json';
            $data = json_encode($backupData, JSON_PRETTY_PRINT);
            // Save locally
            Storage::disk('public')->put("backups/{$fileName}", $data);

            // Initialize Firebase Storage
            $firebase = (new Factory)->withServiceAccount((base_path() . '/app/reg-archive-firebase-adminsdk-140mx-e5a5981a75.json'))->withDefaultStorageBucket('reg-archive.firebasestorage.app');
            $storage = $firebase->createStorage();
            $bucket = $storage->getBucket();

            $bucket->upload(
                fopen(Storage::disk('public')->path("backups/{$fileName}"), 'r'),
                ['name' => "backups/{$fileName}"]
            );


            $this->uploadFolderToFB($filenameBase);

            return redirect('/settings/backup')->with('success_message', 'Backup created successfully! '. $documentBackupStatus);
        } catch (\Exception $e) {
            return redirect('/settings/backup')->with('error_message', value: 'Backup creation failed: ' . $e->getMessage());
        }
    }

    public function uploadFolderToFB(string $backupName): ?string
    {
        try {
            // Initialize Firebase Storage
            $firebase = (new Factory)->withServiceAccount((base_path() . '/app/reg-archive-firebase-adminsdk-140mx-e5a5981a75.json'))->withDefaultStorageBucket('reg-archive.firebasestorage.app');
            $storage = $firebase->createStorage();
            $bucket = $storage->getBucket();


            // Define the source directory
            $sourceDir = storage_path(path: '/app/public/documents');

            if (!is_dir($sourceDir)) {
               return false;
            }

            $zipFilePath = storage_path("app/public/{$backupName}.zip");

            // Create a zip archive of the folder
            $zip = new \ZipArchive();
            if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($sourceDir));
                foreach ($files as $file) {
                    if (!$file->isDir()) {
                        $relativePath = substr($file->getPathname(), strlen($sourceDir) + 1);
                        $zip->addFile($file->getPathname(), $relativePath);
                    }
                }
                $zip->close();
            } else {
                throw new \Exception("Could not create zip file at: $zipFilePath");
            }

            // Set the Firebase destination path
            $firebaseFilePath = "backupDocuments/{$backupName}.zip";

            // Check if the file exists in Firebase Storage
            $object = $bucket->object($firebaseFilePath);
            if ($object->exists()) {
                // Delete the existing file
                $object->delete();
            }

            // Upload the zip file to Firebase Storage
            $bucket->upload(
                fopen($zipFilePath, 'r'),
                [
                    'name' => $firebaseFilePath,
                ]
            );

            // Clean up by deleting the local zip file
            unlink($zipFilePath);

            // Generate and return the file's public URL
            $object = $bucket->object($firebaseFilePath);
            return $object->signedUrl(new \DateTime('+1 year'));
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error("Firebase folder upload error: " . $e->getMessage());
            dd($e->getMessage());
            return null;
        }
    }

    // Restore the entire database
    public function restoreBackup(Request $request)
    {
        try {
            $firebasePath = $request->input('firebase_path');

            if (!$firebasePath) {
                return redirect('/settings/backup')->with('error_message', 'Firebase path is required');
            }

            // Initialize Firebase Storage
            $firebase = (new Factory)->withServiceAccount((base_path() . '/app/reg-archive-firebase-adminsdk-140mx-e5a5981a75.json'))->withDefaultStorageBucket('reg-archive.firebasestorage.app');
            $storage = $firebase->createStorage();
            $bucket = $storage->getBucket();
            $object = $bucket->object($firebasePath);

            $path = $object->name();
            $filenameWithExtension = basename($path);
            $documentFilename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $documentBackupPath = 'backupDocuments/' . $documentFilename . '.zip';

            $documentObject = $bucket->object($documentBackupPath);
            $documentBackupStatus = '';
            if ($documentObject->exists()) {
                try {
                    // Define paths
                    $tempZipPath = storage_path('app/public/temp_documents_backup.zip'); // Temporary zip file
                    $extractPath = storage_path('app/public/temp_documents');           // Temporary extraction folder
                    $sourceDir = storage_path('app/public/documents');           // Target folder to replace

                    // Download the zip file from Firebase
                    file_put_contents($tempZipPath, $documentObject->downloadAsStream());

                    // Unzip the downloaded file
                    $zip = new \ZipArchive();
                    if ($zip->open($tempZipPath) === true) {
                        // Ensure the extraction path exists
                        if (!file_exists($extractPath)) {
                            mkdir($extractPath, 0755, true);
                        }
                        $zip->extractTo($extractPath);
                        $zip->close();
                    } else {
                        throw new \Exception('Failed to unzip the downloaded file.');
                    }

                    // Replace the folder at $sourceDir
                    if (file_exists($sourceDir)) {
                        // Delete the existing folder
                        \File::deleteDirectory($sourceDir);
                    }
                    // Move the extracted folder to the target location
                    \File::moveDirectory($extractPath, $sourceDir);

                    // Clean up temporary files
                    unlink($tempZipPath);
                    \File::deleteDirectory($extractPath);

                    $documentBackupStatus = "Documents are restored.";
                } catch (\Exception $e) {
                    $documentBackupStatus = "Document are found but error in restoration: " . $e->getMessage();
                }

            } else {
                $documentBackupStatus = "Documents for the backup reference not found in Firebase.";
            }


            if (!$object->exists()) {
                return redirect('/settings/backup')->with('error_message', 'Backup file not found in Firebase');
            }

            $content = $object->downloadAsString();
            $backupData = json_decode($content, true);

            if (!$backupData) {
                return redirect('/settings/backup')->with('error_message', 'Invalid backup file');
            }

            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            try {
                // Restore data to each table
                foreach ($backupData as $table => $rows) {
                    if (DB::getSchemaBuilder()->hasTable($table)) {
                        DB::table($table)->truncate();
                        DB::table($table)->insert($rows);
                    }
                }
            } catch (\Exception $e) {
                // Enable foreign key checks again in case of an error
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
                return redirect()->route('backups.index')->with('error_message', 'Error restoring backup: ' . $e->getMessage());
            }

            // Enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');


            return redirect('/settings/backup')->with('success_message', 'Backup restored successfully! ' . $documentBackupStatus);
        } catch (\Exception $e) {
            return redirect('/settings/backup')->with('error_message', 'Backup restored failed: ' . $e->getMessage());

        }
    }
}
