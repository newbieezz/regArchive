<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\Documents;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Illuminate\Support\Facades\Storage;


class DocumentService
{
    /**
     * @var App\Models\Documents
     */
    protected $documents;

    /**
     * DocumentsService constructor.
     *
     * @param App\Models\Documents $user
     */
    public function __construct(Documents $documents)
    {
        $this->documents = $documents;
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
                        ]);
                    }
                }
            }
        } catch (Exception $e) {
            throw $e;
        }

        return;
    }

   
}