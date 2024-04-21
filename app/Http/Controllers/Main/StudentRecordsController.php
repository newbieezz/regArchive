<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\StudentService;

class StudentRecordsController extends Controller
{
        
    /** @var App\Services\StudentService */
    protected $studentService;

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
    public function index()
    {
        $students = Student::paginate(config('app.pages'));
        return view('main.students.index', compact('students'));
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
