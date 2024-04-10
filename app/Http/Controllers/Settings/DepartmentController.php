<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;
use App\Http\Requests\Settings\Department\CreateDepartmentRequest;
use App\Http\Requests\Settings\Department\UpdateDepartmentRequest;
use Illuminate\Validation\ValidationException;
use Exception;
class DepartmentController extends Controller
{

    /** @var App\Services\DeparmentService */
    protected $departmentService;

    /**
     * UserController constructor.
     *
     * @param App\Services\DepartmentService $departmentService
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

        
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::paginate(config('app.pages'));
        return view('settings.department.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $departments = Department::all();
        return view('settings.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDepartmentRequest $request)
    {
        $request->validated();

        $department = $this->departmentService->create($request->all());
        return redirect('/settings/department')->with('success_message','Department has been created successfully.');
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
            $department = $this->departmentService->findById($id);
            return view('settings.department.edit')->with(compact('department'));
        } catch (Exception $e) {
            return redirect('/settings/department');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, int $id)
    {
        try {
            $request->merge(['id' => $id]);
            $request->validated();
            $this->departmentService->update($request->all());
            return redirect('/settings/department')->with('success_message', 'Department updated successfully.');
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
            $this->departmentService->delete($id);
            return redirect()->back()->with('success_message','Department has been deleted successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }
}
