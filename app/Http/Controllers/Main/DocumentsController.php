<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\DocumentService;
use Illuminate\Support\Facades\Storage;

use ZipArchive;
use Exception;
class DocumentsController extends Controller
{
    
    protected $documentService;

    /**
     * DocumentsController constructor.
     *
     * @param
     */
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

     /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $status = null)
    {
        
        $documentRecords = $this->documentService
        ->listByStudent($request->all(), $status);
        //dd($documentRecords);
        return view('main.documents.records', compact('documentRecords', 'request'));
    }

    /**
     * Display a listing of the transactions.
     */
    public function transactions(Request $request)
    {
        $this->documentService->cleanRecords();
        $transactions = $this->documentService->list($request->all());
        // dd($transactions);
        return view('main.documents.transactions', compact('transactions', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $studentId)
    {
        try { 
            $studentData = Student::findOrFail($studentId);
            return view('main.documents.upload', compact('studentId', 'studentData'));
        } catch (Exception $e) {
            return redirect()->back();
        }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $studentId)
    {
        $res = [];
        try { 
            $updload = $this->documentService->uploadDocumnets($request, $studentId);
            $res= [
                'message' => 'Document uploaded successfully.',
                "code" => 200,
            ];
        } catch (Exception $e) {
            $res = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }

        
        return response()->json($res, $res['code']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function download(string $id)
    {
        //$document = Documents::findOrFail($id);
        //$student = Student::findOrFail($id);
        $parts = explode('_', $id);
        //dd($parts);
        $student_id = $parts[0];
        $category_id = $parts[1];
        $action = $parts[2];

        $student = Student::findOrFail($student_id);
        $document_data = $student->documents->where('type', $category_id);
        $current_document = $document_data->first();
        //dd($current_document);
        $path = Storage::path($current_document->file_path);

        if ($action == 'view') {
            return response()->file($path);
        }

        if ($action == 'download') {
            return response()->download($path);
        }
    }

    public function bulkDownload()
    {
        // Define the path of the folder you want to download
        $folderPath = storage_path('app/public/documents');
        $zipFileName = 'documents.zip'; // Name of the zip file

        // Ensure the folder exists
        if (!is_dir($folderPath)) {
            return response()->json(['message' => 'Folder not found.'], 404);
        }

        // Create a zip file
        $zip = new ZipArchive;  
        $zipFilePath = storage_path($zipFileName);

        // Open the zip file
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // Add each file from the folder into the zip
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folderPath));
            foreach ($files as $name => $file) {
                // Ignore directories
                if (!$file->isDir()) {
                    // Get relative path of the file
                    $relativePath = substr($file->getPathname(), strlen($folderPath) + 1);
                    $zip->addFile($file->getPathname(), $relativePath);
                }
            }
            $zip->close();
        } else {
            return response()->json(['message' => 'Failed to create zip file.'], 500);
        }

        // Return the zip file as a download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
