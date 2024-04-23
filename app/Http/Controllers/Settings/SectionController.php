<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Services\SectionService;
use App\Http\Requests\Settings\Section\CreateSectionRequest;
use App\Http\Requests\Settings\Section\UpdateSectionRequest;
use Exception;
use Illuminate\Validation\ValidationException;

class SectionController extends Controller
{
    protected $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index(){
        $sections = Section::paginate(config('app.pages'));
        return view('settings.section.index',compact('sections'));
    }

    public function store(CreateSectionRequest $request){
       
        $request->validated();

        $section = $this->sectionService->create($request->all());
        return redirect('/settings/section')->with('success_message','Section has been created successfully.');
    }

    public function edit(int $id)
    {
        try {
            $section = $this->sectionService->findById($id);
            return view('settings.section.edit')->with(compact('section'));
        } catch (Exception $e) {
            return redirect('/settings/section');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, int $id)
    {
        try {
            $request->merge(['id' => $id]);
            $request->validated();
            $this->sectionService->update($request->all());
            return redirect('/settings/section')->with('success_message', 'Section updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
        
    }

    public function destroy(int $id)
    {
        try {
            $this->sectionService->delete($id);
            return redirect()->back()->with('success_message','Section has been deleted successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }
}
