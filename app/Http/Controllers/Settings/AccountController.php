<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get()->all();
        return view('settings.accounts.accounts')->with(compact( 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.accounts.add_account');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request, $id=null)
    {   if($id==""){

        } else{
            $users = User::find($id);
            $user = User::get()->where('id',$id)->first();
            // dd($id);
            return view('settings.accounts.edit_account')->with(compact('user'));

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
