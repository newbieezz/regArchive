<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Authenticate users.
     */
    public function login(LoginRequest $request){
        try {
            $request->validated();

            if(Auth::attempt(['email'=>$request->getEmail(),'password'=>$request->getPassword()]))
            {
                if(Auth::user()->status->name == config('user.statuses.active')){

                    if (Auth::user()->password_default == 1) {
                        return redirect('update/' . Auth::user()->id)->with('message', 'Please change the default password.');
                    } else {
                        return redirect('dashboard');
                    }
                }else{
                    return redirect()->back()->with('error_message','Account Deactivated');
                }
            }else{
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());

        } 
    }

    /**
     * Logout users.
     */
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
