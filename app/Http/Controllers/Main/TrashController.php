<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\DocumentService;
use App\Models\Documents;
use Illuminate\Support\Facades\Storage;
use Exception;
class TrashController extends Controller
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
        $trashRecords = $this->documentService->trashRecords($request->all());
        return view('settings.trash.trashes', compact('trashRecords', 'request'));
    }

    /**
     * Restore Files
     */
    public function restore(Request $request)
    {
        try{
            $idsString = $request->input('ids');
            $ids = json_decode($idsString, true);

            $file = Documents::whereIn('id', $ids)->withTrashed()->first();
            
            //remove previous dile data
            Documents::where('student_id', $file->student_id)
                ->where('type', $file->type)
                ->update(['deleted_by' => getLoggedInUser()->id]);
            Documents::where('student_id', $file->student_id)->where('type', $file->type)->delete();
            
            //restore trash files
            $trashFiles = Documents::whereIn('id', $ids)->withTrashed();
            $trashFiles->update([
                'deleted_at' => null, // Restore deleted_at to null to "undelete"
                'deleted_by' => null, // Set deleted_by to null
            ]);
            return redirect()->back()->with('success_message', 'Files restored succesfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }
    
    /**
     * Delete Files permanently 
     */
    public function delete(Request $request)
    {
        try{
            $idsString = $request->input('ids');
            $ids = json_decode($idsString, true);
            $files = Documents::whereIn('id', $ids)->withTrashed();
            foreach ($files->get() as $file) {
                Storage::disk('public')->delete($file->file_path);
            }
            $files->forceDelete();
            return redirect()->back()->with('success_message', 'Files pemanently deleted');
        }catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
