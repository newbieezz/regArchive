<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class UserController extends Controller
{

    public function ulogin(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();

            //Laravel validation
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            //For custom message show when error
            $customMessages = [
                'email.required' => 'Email Address is required!',
                'email.email' => 'Valid Email Address is required',
                'password.required' => 'Password is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            // if email and pass is correct proceed to dashboard
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
            {
                return redirect('dashboard');

            }else{
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }

        }
    }

    public function dashboard(){
        return view('dashboard');
    }
    public function login(){
        return view('login');
    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function users(Request $request){
        $users = User::get()->all();
        return view('settings.accounts')->with(compact( 'users'));
    }
    public function addAccount(Request $request){
        return view('account.add_account');

    }

}
