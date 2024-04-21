<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SchoolYear;
use App\Http\Requests\Main\Enrollment\EnrollmentRequest;
use App\Http\Requests\Main\Enrollment\EnrollmentEditRequest;
use App\Services\EnrollmentService;
use Exception;
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
    public function index()
    {
        $enrollments = Enrollment::paginate(config('app.pages'));
        return view('main.enrollment.index',compact('enrollments'));
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
        //
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
