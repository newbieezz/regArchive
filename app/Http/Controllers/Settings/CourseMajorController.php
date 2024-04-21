<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Validation\ValidationException;
use App\Services\MajorService;
use App\Http\Requests\Settings\Major\MajorRequest;
use Exception;
class CourseMajorController extends Controller
{

    /** @var App\Services\MajorService */
    protected $majorService;

    /**
     * UserController constructor.
     *
     * @param App\Services\MajorService $departmentService
     */
    public function __construct(MajorService $majorService)
    {
        $this->majorService = $majorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $majors = Major::byCourse($id)->paginate(config('app.pages'));
        $courseId = $id;
        return view('settings.major.index', compact('majors', 'courseId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $courseId = $id;
        return view('settings.major.create', compact('courseId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MajorRequest $request, $id)
    {
        $request->merge(['course_id' => $id]);
        $request->validated();
        $major = $this->majorService->create($request->all());
        return redirect('settings/major/'.$id)->with('success','Course Major has been created successfully.');
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
    public function update(MajorRequest $request, int $id)
    {   
        try {
            $request->merge(['id' => $id]);
            $request->validated();
            $major = $this->majorService->update($request->all());
            return redirect('/settings/major/'.$major->course->id)->with('success_message', 'Course Major updated successfully.');
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
            $this->majorService->delete($id);
            return redirect()->back()->with('success_message','Major has been deleted successfully');
        }catch (Exception $e) {
            throw $e;
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Get majors by course
     */
    public function getMajorsByCourse(int $courseId)
    {
        try {
            $majors = $this->majorService->listByCourse($courseId);
            return $majors;
        }catch (Exception $e) {
            return $e;
        }
    }
}
