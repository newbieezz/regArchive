<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{

    public function login(Request $request){
        if($request->ajax()){
            $data = $request->all();

             //requires validation
             $validator = Validator::make($request->all(),[  
                'email' => 'required|email|max:150|exists:users',
                'password' => 'required|min:6',
            ]);

            if($validator->passes()){
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    // return redirect('dashboard');
                    $redirectTo = url('dashboard'); //sending to cart page
                    return response()->json(['type'=>'success','url'=>$redirectTo]);
                } else { //if auth is incorrect
                    return response()->json(['type'=>'incorrect','message'=>'Incorrect Password']);
                }
            } else {
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }

    public function dashboard(){
        return view('dashboard');
    }
}
