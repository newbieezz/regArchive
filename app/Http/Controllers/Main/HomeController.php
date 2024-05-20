<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Exception;
use App\Services\UserService;
use App\Services\StudentService;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Settings\Users\UpdateUserRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userService;

    /** @var App\Services\StudentService */
    protected $studentService;

    /**
     * UserController constructor.
     *
     * @param App\Services\UserService $userService
     */
    public function __construct(UserService $userService, StudentService $studentService)
    {
        $this->userService = $userService;
        $this->studentService = $studentService;
    }
    public function index()
    {
        $reports = $this->studentService->getReports();
        return view('dashboard', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function edit(string $id)
    {
        //
    }
    public function editprofile(Request $request, int $id)
    {  
        try {
            $user = User::findOrFail($id);
            $departments = Department::all();
            return view('main.profile.index')->with(compact('user','departments'));
        } catch (Exception $e) {
            return redirect('/dashboard');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateprofile(Request $request, string $id)
    {
        try {
            $request->merge(['id' => $id]);
            if(empty($request->input('password'))){
                $request->except(['password', 'password_confirmation']);
            }
            // $request->validated();
            // dd($id);
            $this->userService->updateStaff($request->all(), $id);
            return redirect('/dashboard')->with('success_message', 'Account updated successfully.');
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
