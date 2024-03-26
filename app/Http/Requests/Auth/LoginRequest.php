<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email Address is required!',
            'email.email' => 'Valid Email Address is required',
            'password.required' => 'Password is required!',
        ];
    }

    public function getEmail(): ?string
    {
        return $this->input('email', null);
    }

    public function getPassword(): ?string
    {
        return $this->input('password', null);
    }
}
