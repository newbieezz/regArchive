<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Settings\Course\CreateCourseRequest;
use App\Http\Requests\Settings\Course\UpdateCourseRequest;
use App\Services\CourseService;
use Exception;
class CourseController extends Controller
{

    /** @var App\Services\CourseService */
    protected $courseService;

    /**
     * UserController constructor.
     *
     * @param App\Services\CourseService $departmentService
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->filled('dept')) {
            $dept = request('dept');
            $courses = Course::byDepartment($dept)->paginate(config('app.pages'));
        } else {
            $courses = Course::paginate(config('app.pages'));
        }
        $departments = Department::all();
        return view('settings.course.index', compact('courses','departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('settings.course.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCourseRequest $request)
    {
        $request->validated();
        $department = $this->courseService->create($request->all());
        return redirect($request->has('redirect') ? $request->input('redirect') : 'settings/course/')->with('success','Course has been created successfully.');
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
    public function edit(int $id)
    {
        try {
            $departments = Department::all();
            $course = $this->courseService->findById($id);
            return view('settings.course.edit')->with(compact('course','departments'));
        } catch (Exception $e) {
            return redirect('/settings/department');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, int $id)
    {   

        try {
            $request->merge(['id' => $id]);
            $request->validated();
            $this->courseService->update($request->all());
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
    public function destroy(int $id)
    {
        try {
            $this->courseService->delete($id);
            return redirect()->back()->with('success_message','Course has been deleted successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Get courses by departments
     */
    public function getCouresByDepartment(int $departmentId)
    {
        try {
            $courses = $this->courseService->listByDepartment($departmentId);
            return $courses;
        }catch (Exception $e) {
            return $e;
        }
    }
}
