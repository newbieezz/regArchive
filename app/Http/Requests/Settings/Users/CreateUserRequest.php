<?php

namespace App\Http\Requests\Settings\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // confirmed rule for matching passwords
        ];
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
            'department_id.required' => 'Department is required!',
            'email.required' => 'Email Address is required!',
            'email.email' => 'Valid Email Address is required!',
            'email.max' => 'Email Address must less than 255 characters!',
            'email.unique' => 'Email Address already exist!',
            'email.string' => 'Email Address must be a string!',
            'password.required' => 'Password is required!',
            'password.string' => 'Password must be a string!',
            'password.min' => 'Password must be 8 characters long!',
            'password.confirmed' => 'Password confirmation did not match',
        ];
    }
}
