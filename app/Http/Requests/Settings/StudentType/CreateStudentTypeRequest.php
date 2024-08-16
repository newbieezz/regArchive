<?php

namespace App\Http\Requests\Settings\StudentType;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'letter_tag' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Section name is required!',
            'name.string' => 'Section name  must be a string!',
            'name.max' => 'Section name  must less than 255 characters!',
            'letter_tag.required' => 'Section letter_tag is required!',
            'letter_tag.string' => 'Section letter_tag  must be a string!',
            'letter_tag.max' => 'Section letter_tag  must less than 255 characters!',
        ];
    }
}
