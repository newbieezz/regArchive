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
    public function index(Request $request)
    {
        return view('main.documents.records', compact('request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $studentId)
    {
        try { 
            $enrollment = Student::findOrFail($studentId);
            return view('main.documents.upload', compact('studentId'));
        } catch (Exception $e) {
            return redirect()->back();
        }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $studentId)
    {
        try { 
            $this->documentService->uploadDocumnets($request, $studentId);
            return redirect('/documents/records')->with('success_message', 'Document uploaded successfully.');
        } catch (Exception $e) {
            throw $e;
        }
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
