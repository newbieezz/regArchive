<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\DocumentService;

class DocumentsController extends Controller
{
    /** @var App\Services\DocumentService */
    protected $documentService;

    /**
     * DocumentsController constructor.
     *
     * @param App\Services\DocumentService $enrollmentService
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
        $documentRecords = $this->documentService->listByStudent($request->all(), $status);
        return view('main.documents.records', compact('documentRecords', 'request'));
    }

    /**
     * Display a listing of the transactions.
     */
    public function transactions(Request $request)
    {
        $transactions = $this->documentService->list($request->all());
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
}
