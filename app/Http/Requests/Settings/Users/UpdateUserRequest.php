<?php

namespace App\Http\Requests\Settings\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            // 'first_name' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'department' => 'required',
            // 'scope' => 'required',
            // 'email' => 'required|string|email|max:255',
            // 'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ];

        if(isset($this->password)){
            $rules['password'] = [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ];
        }

        $user = User::find($this->id);

        // if($user && $this->email != $user->email){
        //     $rules['email'] = 'required|string|email|max:255|unique:users';
        // }

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required!',
            'first_name.string' => 'First Name must be a string!',
            'first_name.max' => 'First Name  must less than 255 characters!',
            'last_name.required' => 'Last Name is required!',
            'last_name.string' => 'Last Name must be a string!',
            'last_name.max' => 'Last Name  must less than 255 characters!',
            'department.required' => 'Department is required!',
            'scope.required' => 'Department is required!',
            'email.required' => 'Email Address is required!',
            'email.email' => 'Valid Email Address is required!',
            'email.max' => 'Email Address must less than 255 characters!',
            'email.unique' => 'Email Address already exist!',
            'email.string' => 'Email Address must be a string!',
            'password.regex' => 'Password must contain at least one letter, one number, and one special character.',
            'password.required' => 'Password is required!',
            'password.string' => 'Password must be a string!',
            'password.min' => 'Password must be 8 characters long!',
            'password.confirmed' => 'Password confirmation did not match',
        ];
    }
}

