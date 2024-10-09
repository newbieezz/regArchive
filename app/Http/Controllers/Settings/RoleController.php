<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return view("settings.role.index", ["roles" => $roles]);
    }

    public function create()
    {
        return view("settings.role.create");
    }

    public function store(Request $request)
    {
        //dd($request);
        $data = $request->validate([
            "value" => "required",
            "code" => "required|numeric",
            "added_by" => "nullable",
        ]);

        $product = Role::create($data);
        return redirect(route('product.index'));
    }

    public function edit(Role $role)
    {
        //dd($role);
        //return view('settings.role.edit', ['role' => $role]);
    }

    public function update(Role $product, Request $request)
    {

        $data = $request->validate([
            "value" => "required",
            "code" => "required|numeric",
            "added_by" => "nullable",
        ]);
        $product->update($data);

        return redirect(route("settings.role.index"))->with("success", "Role Updated Successfully!");

    }
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);

            // perform delete
            $role->delete();

            return redirect()->back()->with('success_message', 'Role has been deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }
}
