<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DocumentService;
use Symfony\Component\Process\Process;

class DocumentController extends Controller
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
        parent::__construct();
        $this->documentService = $documentService;
    }

        
    public function scan(Request $request, int $student, int $category,)
    {
        try { 
            return $this->documentService->scan($request, $student, $category);
        } catch (Exception $e) {
            return response()->json(['message' => 'Scanning failed'], 500);
        }
    }
    
}
