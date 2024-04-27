<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SchoolYear;
use App\Http\Requests\Main\Enrollment\EnrollmentRequest;
use App\Http\Requests\Main\Enrollment\EnrollmentEditRequest;
use App\Http\Requests\Main\Enrollment\BulkEnrollmentRequest;
use App\Services\EnrollmentService;
use Exception;
use Illuminate\Validation\ValidationException;
class EnrollmentRecordsController extends Controller
{
    
    /** @var App\Services\EnrollmentService */
    protected $enrollmentService;

    /**
     * UserController constructor.
     *
     * @param App\Services\EnrollmentService $enrollmentService
     */
    public function __construct(EnrollmentService $enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
    }

     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $enrollments = $this->enrollmentService->list($request->all());
        return view('main.enrollment.index',compact('enrollments', 'request'));
    }

    /**
     * Show the form for bulk import.
     */
    public function import()
    {
        return view('main.enrollment.import');
    }

    public function upload(BulkEnrollmentRequest $request)
    {
        try {
            $request->validated();
            $enrollment = $this->enrollmentService->uploadStudents($request->all());
            return redirect('/enrollment')->with('success_message', 'Data imported successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            throw $e;
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.enrollment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnrollmentRequest $request)
    {
        try {
            $request->validated();
            $enrollment = $this->enrollmentService->create($request->all());
            return redirect('/enrollment')->with('success_message', 'Enrollment added successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            throw $e;
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try { 
            $enrollment = Enrollment::findOrFail($id);
            return view('main.enrollment.show')->with(compact('enrollment'));
        } catch (Exception $e) {
            return redirect('/enrollment');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try { 
            $enrollment = Enrollment::findOrFail($id);
            return view('main.enrollment.edit')->with(compact('enrollment'));
        } catch (Exception $e) {
            return redirect('/enrollment');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnrollmentEditRequest $request, string $id)
    {
        try {
            $request->merge(['id' => $id]);
            $request->validated();
            $this->enrollmentService->update($request->all());
            return redirect('/enrollment')->with('success_message', 'Enrollment record updated successfully.');
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
        //
    }
}
