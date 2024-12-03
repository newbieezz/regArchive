<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Documents;
use App\Models\DocumentCategory;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Illuminate\Support\Facades\Storage;
use Log;
use Symfony\Component\Process\Process;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage as FBStorage;
use Illuminate\Http\UploadedFile;


class DocumentService
{
    /**
     * @var App\Models\Documents
     */
    protected $documents;

    protected $studentService;

    /**
     * DocumentsService constructor.
     *
     * @param App\Models\Documents $user
     */
    public function __construct(Documents $documents)
    {
        $this->documents = $documents;
        $this->studentService = app(StudentService::class);
    }

    /**
     * List all Documents
     *
     * @param array $params
     */
    public function list(array $request)
    {
        try {
            $documents = $this->documents->withTrashed();
            $filteredDocuments = $this->searchFilterList($request, $documents);
            $documents = $documents->orderBy('updated_at', 'desc');
            return $documents->paginate(config('app.pages'));
        } catch (Exception $e) {
            throw $e;
        }

        return $enrollment;
    }


    /**
     * List all Documents by students with filters
     *
     * @param array $params
     */
    public function listByStudent(array $request, $status = null)
    {
        try {
            $students = Student::query()->status($status);
            $filteredStudents = $this->studentService->searchFilterList($request, $students);
            return $filteredStudents->paginate(config('app.pages'));
        } catch (Exception $e) {
            throw $e;
        }

        return $enrollment;
    }

    /**
     * Delete a file from Firebase Storage.
     *
     * @param string $filePath The file path in Firebase Storage.
     * @return bool True if deleted successfully, False otherwise.
     */
    

    function formatFilePaths(string $input): string
    {
        // Split the string by " and "
        $files = explode(' and ', $input);

        if (count($files) < 2) {
            throw new Exception("Invalid input format. Expected 'file1 and file2'.");
        }

        // Extract student ID from the first file
        $firstFile = $files[0];
        $studentId = strstr($firstFile, '_', true); // Get everything before the first underscore

        // Prepend the student ID as a folder to the first file
        $files[0] = "{$studentId}/{$firstFile}";

        // Join the files back with " and "
        return implode(' and ', $files);
    }

    public function cleanRecords()
    {
        try {
            $expiredDocuments = $this->documents->where('expiration', '<', now())->get();
            if ($expiredDocuments->isNotEmpty()) {
                foreach ($expiredDocuments as $expiredDocument) {
                    $expiredDocument->delete();
                    
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * List all Trash Documents 
     *
     * @param array $params
     */
    public function trashRecords(array $request)
    {
        try {
            $trashRecords = $this->documents->onlyTrashed()
                ->select('student_id', 'type', 'deleted_by', 'deleted_at')
                ->groupBy('student_id', 'type', 'deleted_by', 'deleted_at')
                ->with(['category', 'deletedByUser'])
                ->orderBy('deleted_at', 'desc');

            $trashRecords = $this->searchFilterList($request, $trashRecords);
    
            $trashRecords = $trashRecords->paginate(config('app.pages'));

            foreach ($trashRecords as &$record) {
                $record->files = $this->documents->onlyTrashed()
                    ->with('category')
                    ->where('student_id', $record->student_id)
                    ->where('type', $record->type)
                    ->where('deleted_by', $record->deleted_by)
                    ->where('deleted_at', $record->deleted_at)
                    ->get();
            }
            
            return $trashRecords;
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Upload documents
     *
     * @param array $params
     */
    public function uploadDocumnets(Request $request, $studentId)
    {
        try {
            $student = Student::findOrFail($studentId);
            // Loop through each category
            foreach (getDocumentCategories() as $category) {
                // Check if files are uploaded for the current category
                if ($request->hasFile('file.' . $category->id)) {
                    
                    // Get the array of files for the current category
                    $files = $request->file('file.' . $category->id);
                    $basePath = 'documents/'.$student->student_id.'/';


                    //remove previous dile data
                    $this->documents->where('student_id', $student->student_id)->where('type', $category->id)->update(['deleted_by' => getLoggedInUser()->id]);
                    $this->documents->where('student_id', $student->student_id)->where('type', $category->id)->delete();
                    // Process each file
                    foreach ($files as $file) {
                        $key = Str::random(10);
                        $customFilename = $student->student_id.'_'. $category->type.'_' .$key.'.'.$file->getClientOriginalExtension();
                        $fullPath = $basePath . $customFilename;

                        Storage::disk('public')->put($fullPath, file_get_contents($file));

                        $this->documents->create([
                            'student_id' => $student->student_id,
                            'type' => $category->id,
                            'file_name' => $customFilename,
                            'file_path' => $fullPath,
                            'added_by' => getLoggedInUser()->id,
                            'expiration' => $request->expiration,
                        ]);
                    }
                }
            }
            //Clean temp files of scanned documents
            $tempDirectory = 'temp/user_'.getLoggedInUser()->id.'/'.$student->student_id;
            // Check if the directory exists
            if (Storage::disk('public')->exists($tempDirectory)) {
                // Delete the directory and its contents
                Storage::disk('public')->deleteDirectory($tempDirectory);
            }

            $student->updateDocumentStatus();
            return true;
        } catch (Exception $e) {
            throw $e;
        }

        return;
    }

   

    public function scan(Request $request, $studentID, $categoryID){
        try {
            $student = Student::findOrFail($studentID);
            $category = DocumentCategory::findOrFail($categoryID);
            $userId = $request->input('userId');
    
            $outputDirectory = 'temp/user_'.$userId.'/'.$student->student_id.'/'.$category->type;
            $filename = $category->type.'_'.time().'.jpg'; // Assuming the scanned document is saved as a PDF
    
            // Define the output path on the storage disk
            $storagePath = $outputDirectory.'/'.$filename;
            Storage::disk('public')->makeDirectory($outputDirectory, 0755, true);
            $storagePath = str_replace('/', '\\', $storagePath);
            // Run NAPS2 command to scan directly to the storage disk
            $process = new Process([
                'C:\Program Files\NAPS2\naps2.console.exe', // Path to NAPS2 executable
                '--output', str_replace('/','\\',Storage::disk('public')->path($storagePath)), // Output directory for scanned documents
            ]);
            $process->run();
    
            // Check if scanning was successful
            if (!$process->isSuccessful()) {
                return response()->json(['message' => 'Scanning failed', 'error' => $process->getErrorOutput()], 500);
            }
            return response()->json(['path' =>  $storagePath], 200);
    
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function searchFilterList($conditions, $query)
    {
        // if main_query is provided
        if (array_key_exists('main_query', $conditions) && checkSearchHasValue($conditions['main_query'])) {
            $query = $query->where('student_id', 'LIKE', "%{$conditions['main_query']}%")
            ->orWhere(function ($innerQuery) use ($conditions) {
                $innerQuery->whereHas('addedByUser', function ($query) use ($conditions) {
                    $query->where('first_name', 'LIKE', "%{$conditions['main_query']}%")
                        ->orWhere('last_name', 'LIKE', "%{$conditions['main_query']}%");
                })->orWhereHas('deletedByUser', function ($query) use ($conditions) {
                    $query->where('first_name', 'LIKE', "%{$conditions['main_query']}%")
                        ->orWhere('last_name', 'LIKE', "%{$conditions['main_query']}%");
                });
            });
        }
        // if type is provided
        if (array_key_exists('type', $conditions) && checkSearchHasValue($conditions['type'])) {
            $query = $query->where('type', intval($conditions['type']));
        }

        // if user_id is provided
        if (array_key_exists('user_id', $conditions) && checkSearchHasValue($conditions['user_id'])) {
            $query = $query->where('deleted_by', intval($conditions['user_id']))->orWhere('added_by', intval($conditions['user_id']));
        }
        return $query;
    }

   
}