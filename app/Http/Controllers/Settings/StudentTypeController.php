<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StudentTypeService;
use App\Http\Requests\Settings\StudentType\CreateStudentTypeRequest;
use App\Http\Requests\Settings\StudentType\UpdateStudentTypeRequest;
use App\Models\StudentType;
use Exception;
use Illuminate\Validation\ValidationException;

class StudentTypeController extends Controller
{
    protected $studentTypeService;

    public function __construct(StudentTypeService $studentTypeService)
    {
        $this->studentTypeService = $studentTypeService;;
    }

    public function index(){
        $studentTypes = StudentType::paginate(config('app.pages'));
        return view('settings.student_type.index', compact('studentTypes'));
    }

    public function store(CreateStudentTypeRequest $request){
        $request->validated();
        $studentType = $this->studentTypeService->create($request->all());
        return redirect('/settings/studentType')->with('success_message','Student Type Required Reference has been created successfully');
    }

    public function edit(int $id)
    {
        try {
            $studentType = $this->studentTypeService->findById($id);
            return view('settings.student_type.edit')->with(compact('studentType'));
        } catch (Exception $e) {
            return redirect('/settings/studentType');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentTypeRequest $request, int $id)
    {
        try {
            $request->merge(['id' => $id]);
            $request->validated();
            $this->studentTypeService->update($request->all());
            return redirect('/settings/studentType')->with('success_message', 'StudentType Required Reference updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
        
    }

    public function destroy(int $id)
    {
        try {
            $this->studentTypeService->delete($id);
            return redirect()->back()->with('success_message','Student Type Required Reference has been deleted successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }
}
