<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Validation\ValidationException;
use Exception;
class CourseMajorController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $majors = Major::paginate(config('app.pages'));
        $course_id = $id;
        $courses = Course::get()->toArray();

        //temporary pani kuys for the sake sa VIEW sa table rani, 
        //ikaw na bahala connect'2 sa mga id ani nila haha lamats!
        return view('settings.major.index', compact('course_id','majors','courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $course = Course::select('id')->with('major')->find($id);

        // dd($course);
        return view('settings.major.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $course = Course::select('id')->with('major')->find($id);
        $request->validate([
            'course_id' => 'required',
            'name' => 'required'
        ]);

        $major = new Major;

        $major->name = $request->name;
        $major->course_id = $request->course_id;
        // dd($request);
        $major->save();

     
        return redirect()->with('success','Course Major has been created successfully.');
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
        $course = Course::select('id')->with('major');

        try { 
            $major = Major::findOrFail($id);
            return view('settings.major.edit')->with(compact('major','course'));
        } catch (Exception $e) {
            return redirect('/settings/major');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        try {
            $request->validate([
                'name' => 'required',
              ]);
              $major = Major::find($id);
              $major->update($request->all());
            return redirect('/settings/major/'.$major['course_id'])->with('success_message', 'Course Major updated successfully.');
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
