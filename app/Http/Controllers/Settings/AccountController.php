<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Services\UserService;
use App\Http\Requests\Settings\Users\CreateUserRequest;
use App\Http\Requests\Settings\Users\UpdateUserRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class AccountController extends Controller
{

    /** @var App\Services\UserService */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param App\Services\UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $users = User::paginate(config('app.pages'));
        
        $departments = Department::all();
        // dd($users);
        // $users = User::paginate(config('app.pages'));
        return view('settings.accounts.index', compact('users','departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('settings.accounts.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $request->validated();
            $user = $this->userService->createStaff($request->all());
            return redirect('/settings/user')->with('success_message', 'Account added successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
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
    public function edit(Request $request, int $id)
    {  
        try {
            $user = User::findOrFail($id);
            $departments = Department::all();
            return view('settings.accounts.edit')->with(compact('user','departments'));
        } catch (Exception $e) {
            return redirect('/settings/user');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // try {
        //     $request->merge(['id' => $id]);
        //     if(empty($request->input('password'))){
        //         $request->except(['password', 'password_confirmation']);
        //     }
        //     $request->validated();
        //     $this->userService->updateStaff($request->all(), $id);
        //     return redirect('/settings/user')->with('success_message', 'Account updated successfully.');
        // } catch (ValidationException $e) {
        //     return redirect()->back()->withErrors($e->validator->errors())->withInput();
        // } catch (Exception $e) {
        //     return redirect()->back()->with('error_message', $e->getMessage());
        // }
        try {
            $request->merge(['id' => $id]);
            if(empty($request->input('password'))){
                $request->except(['password', 'password_confirmation']);
            }
            // $request->validated();
            // dd($id);
            $this->userService->updateStaff($request->all(), $id);
            return redirect('/settings/user')->with('success_message', 'Account updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Activate user account
     */
    public function activate(string $id)
    {
        try {
            $user = $this->userService->setStatus($id, config('user.statuses.active'));
            return redirect()->back()->with('success_message', 'Account '.$user->email.' activated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Deactivate user account
     */
    public function deactivate(string $id)
    {
        try {
            $user =$this->userService->setStatus($id, config('user.statuses.inactive'));
            return redirect()->back()->with('success_message', 'Account '.$user->email.' deactivated successfully.');
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
