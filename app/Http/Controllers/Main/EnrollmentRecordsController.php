<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Department;
use Exception;
class EnrollmentRecordsController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Enrollment::paginate(config('app.pages'));
        $departments = Department::get()->toArray();
        return view('main.students.enrollment',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('main.students.create');
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
        try { 
            $students = Enrollment::findOrFail($id);
            return view('smain.students.edit')->with(compact('students'));
        } catch (Exception $e) {
            return redirect('student/enrollment');
        }
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
