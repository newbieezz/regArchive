<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{

    public function login(Request $request){
        // if($request->ajax()){
        //     $data = $request->all();

        //      //requires validation
        //      $validator = Validator::make($request->all(),[  
        //         'email' => 'required|email|max:150|exists:users',
        //         'password' => 'required|min:6',
        //     ]);

        //     if($validator->passes()){
        //         if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
        //             // return redirect('dashboard');
        //             $redirectTo = url('dashboard'); //sending to cart page
        //             return response()->json(['type'=>'success','url'=>$redirectTo]);
        //         } else { //if auth is incorrect
        //             return redirect()->back()->with('error_message','Invalid Email or Password');
        //         }
        //     } else {
        //         return response()->json(['type'=>'error','errors'=>$validator->messages()]);
        //     }
        // }
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

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
