<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\EnrollmentLog;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SchoolYear;
use App\Http\Requests\Main\Enrollment\EnrollmentRequest;
use App\Http\Requests\Main\Enrollment\EnrollmentEditRequest;
use App\Http\Requests\Main\Enrollment\BulkEnrollmentRequest;
use App\Services\EnrollmentService;
use Exception;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExport;
use App\Models\StudentType;
use App\Services\StudentTypeService;

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
    public function index(Request $request, $status = null)
    {
        $enrollments = $this->enrollmentService->list($request->all(), $status);
        return view('main.enrollment.index',compact('enrollments', 'request'));
    }

    /**
     * Show the form for bulk import.
     */
    public function import()
    {
        $studentTypes = StudentType::get();
        return view('main.enrollment.import',compact('studentTypes'));
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
        $studentTypes = StudentType::get();
        return view('main.enrollment.create',compact('studentTypes'));
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
            $student = $enrollment->student()->first();
            // Fetch the enrollment logs for this student and load related models
            $enrollmentLogs = EnrollmentLog::where('student_id', $student->student_id)
                ->with([
                    'schoolYear',
                    'department',
                    'addedBy',
                    'course',
                    'major',
                ])
                ->withTrashed()
                ->orderBy('created_at', 'desc')
                ->get();
            //dd($enrollmentLogs);

            return view('main.enrollment.show')->with(compact('enrollment', 'enrollmentLogs'));
        } catch (Exception $e) {
            dd($e);
            return redirect('/enrollment');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try { 
            $studentTypes = StudentType::get();
            $enrollment = Enrollment::findOrFail($id);
            return view('main.enrollment.edit')->with(compact('enrollment','studentTypes'));
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

     public function export_data()
    {
        return Excel::download(new StudentExport($this->enrollmentService),'students.xlsx');
    }
}
