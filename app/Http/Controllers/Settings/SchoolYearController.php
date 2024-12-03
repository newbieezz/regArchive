<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SchoolYear\CreateSchoolYearRequest;
use App\Http\Requests\Settings\SchoolYear\UpdateSchoolYearRequest;
use App\Models\SchoolYear;
use App\Services\SchoolYearService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

class SchoolYearController extends Controller
{
    protected $schoolYearService;

    public function __construct(SchoolYearService $schoolYearService)
    {
        $this->schoolYearService = $schoolYearService;
    }

    public function index(){
        $schoolYear = SchoolYear::orderBy('created_at', 'desc')
            ->paginate(config('app.pages'));
        return view('settings.schoolyear.index',compact('schoolYear'));
    }

    public function store(CreateSchoolYearRequest $request){
       
        $request->validated();

        $schoolYear = $this->schoolYearService->create($request->all());
        return redirect('/settings/schoolyear')->with('success_message','Department has been created successfully.');
    }

    public function edit(int $id)
    {
        try {
            $schoolYear = $this->schoolYearService->findById($id);
            return view('settings.schoolyear.edit')->with(compact('schoolYear'));
        } catch (Exception $e) {
            return redirect('/settings/schoolyear');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolYearRequest $request, int $id)
    {
        try {
            $request->merge(['id' => $id]);
            $request->validated();
            $this->schoolYearService->update($request->all());
            return redirect('/settings/schoolyear')->with('success_message', 'School Year updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
        
    }

    public function destroy(int $id)
    {
        try {
            $this->schoolYearService->delete($id);
            return redirect()->back()->with('success_message','School Year has been deleted successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }
}
