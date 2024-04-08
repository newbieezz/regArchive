<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Validation\ValidationException;
use Exception;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(config('app.pages'));
        $department = Department::get()->toArray();
        // dd($getDepartment);
        return view('settings.course.index', compact('courses','department'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        // dd($departments);
        return view('settings.course.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required'
        ]);

        $course = new Course;

        $course->name = $request->name;
        $course->code = $request->code;
        $course->department_id = $request->department_id;
        // dd($request);
        $course->save();

     
        return redirect('settings/course/')->with('success','Course has been created successfully.');
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
        try { $getDepartment = Department::get()->toArray();
            $course = Course::findOrFail($id);
            return view('settings.course.edit')->with(compact('course','getDepartment'));
        } catch (Exception $e) {
            return redirect('/settings/course');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        try {
            $request->validate([
                'code' => 'required',
                'name' => 'required',
                'department_id' => 'required',
              ]);
              $course = Course::find($id);
              $course->update($request->all());
            return redirect('/settings/course')->with('success_message', 'Course updated successfully.');
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
