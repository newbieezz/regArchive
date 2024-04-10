<?php

namespace App\Http\Requests\Settings\Department;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255|unique:departments',
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Department code is required!',
            'code.string' => 'Department code  must be a string!',
            'code.max' => 'Department code  must less than 255 characters!',
            'code.unique' => 'Department code already exist!',
            'name.required' => 'Department name is required!',
            'name.string' => 'Department name must be a string!',
            'name.max' => 'Department name must less than 255 characters!',
        ];
    }
}
