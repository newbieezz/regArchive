<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\StudentService;
use App\Services\EnrollmentService;
use Exception;
use Illuminate\Support\Facades\View;
class StudentRecordsController extends Controller
{
        
    /** @var App\Services\StudentService */
    protected $studentService;
    protected $enrollmentService;

    /**
     * UserController constructor.
     *
     * @param App\Services\StudentService $studentService
     */
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $status = null)
    {
        $students = $this->studentService->list($request->all(), $status);
        // dd($students);
        return view('main.students.index', compact('students', 'request'));
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
        try {
            $student = Student::findOrFail($id);
            $enrollment = Enrollment::where('student_id', $student->student_id)
                                  ->latest()
                                  ->firstOrFail()->get();
            return view('main.students.show', compact( 'enrollment','student'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Student or enrollment record not found');
        }

        // $student = Student::find($id);
        // $enrollment = Enrollment::where('student_id', $student->student_id)->get();
        // dd($student->enrollment->school_year_id);
        // return view('main.students.show', compact('student','enrollment'));
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

    /**
     * Get student by Id
     */
    public function getSudentById(string $studentId)
    {
        try {
            return $this->studentService->findByStudentId($studentId);
        } catch (Exception $e) {
            return $e;
        }
    }


}