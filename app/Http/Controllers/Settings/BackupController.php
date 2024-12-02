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
            $fileName = "backup_database_" . now()->format('Ymd_His') . '.json';
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

            $object = $bucket->object("backups/{$fileName}");
            $file_url = $object->signedUrl(new \DateTime('+1 year'));
            //dd($file_url);

            return redirect('/settings/backup')->with('success_message', 'Backup created successfully!');
        } catch (\Exception $e) {
            Log::error("Firebase backup error: " . $e->getMessage());
            return redirect('/settings/backup')->with('error_message', value: 'Backup creation failed!');
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


            return redirect('/settings/backup')->with('success_message', 'Backup restored successfully!');
        } catch (\Exception $e) {
            return redirect('/settings/backup')->with('error_message', 'Backup restored failed: ' . $e->getMessage());

        }
    }
}
