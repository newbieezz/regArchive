<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DocumentCategory::paginate(config('app.pages'));
        return view('settings.requirements.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.requirements.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'description' => 'required'
        ]);

        $category = new DocumentCategory;

        $category->type = $request->type;
        $category->description = $request->description;
        $category->save();

     
        return redirect('/settings/requirement')->with('success','Document Category has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = DocumentCategory::findOrFail($id);
            return view('settings.requirements.edit')->with(compact('category'));
        } catch (Exception $e) {
            return redirect('/settings/requirement');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'type' => 'required',
                'description' => 'required',
              ]);
              $category = DocumentCategory::find($id);
              $category->update($request->all());
            return redirect('/settings/requirement')->with('success_message', 'Document Category updated successfully.');
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
