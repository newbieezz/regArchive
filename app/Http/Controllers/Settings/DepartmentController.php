<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
class DepartmentController extends Controller
{
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
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required'
        ]);

        $department = new Department;

        $department->name = $request->name;
        $department->code = $request->code;
        $department->save();

     
        return redirect('/settings/department')->with('success','Department has been created successfully.');
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
            $department = Department::findOrFail($id);
            return view('settings.department.edit')->with(compact('department'));
        } catch (Exception $e) {
            return redirect('/settings/department');
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
              ]);
              $department = Department::find($id);
              $department->update($request->all());
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
    public function destroy(string $id)
    {
        // $department->delete();
    
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully');
    
    }
}
