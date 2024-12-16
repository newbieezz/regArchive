<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use App\Models\Enrollment;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Services\DocumentCategoryService;
use App\Http\Requests\Settings\DocumentCategory\DocumentCategoryRequest;
use Exception;
use App\Models\StudentType;
class RequirementController extends Controller
{

    /** @var App\Services\DocumentCategoryService */
    protected $requirementService;
    protected $enrollmentService;

    /**
     * UserController constructor.
     *
     * @param App\Services\DocumentCategoryService $departmentService
     */
    public function __construct(DocumentCategoryService $requirementService, EnrollmentService $enrollmentService)
    {
        $this->requirementService = $requirementService;
        $this->enrollmentService = $enrollmentService;
    }
    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $studentTypes = StudentType::get();
        $categories = DocumentCategory::orderBy('created_at', 'desc')
            ->paginate(config('app.pages'));
        return view('settings.requirements.index',compact('categories','studentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studentTypes = StudentType::get();
        return view('settings.requirements.create',compact('studentTypes'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentCategoryRequest $request)
    {
        $request->merge([
            'expire_at' => max(0, $request->input('expire_at'))
        ]);
        $request->validated();
        
        $category =  $this->requirementService->create($request->all());
        $this->enrollmentService->refreshEnrollmentStatus();
        return redirect('/settings/requirement')->with('success','Document Category has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $studentTypes = StudentType::get();
            $category = $this->requirementService->findById($id);
            $this->enrollmentService->refreshEnrollmentStatus();
            return view('settings.requirements.edit')->with(compact('category','studentTypes'));
        } catch (Exception $e) {
            return redirect('/settings/requirement');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DocumentCategoryRequest $request, int $id)
    {

        try {
            $request->merge(['id' => $id]);
            $request->merge([
                'expire_at' => max(0, $request->input('expire_at'))
            ]);
            $request->validated();

            $this->requirementService->update($request->all());
            $this->enrollmentService->refreshEnrollmentStatus();
            return redirect('/settings/requirement')->with('success_message', 'Document Category updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->requirementService->delete($id);
            $this->enrollmentService->refreshEnrollmentStatus();
            return redirect()->back()->with('success_message','Document Category has been deleted successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

}
