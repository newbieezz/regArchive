<?php

namespace App\Http\Requests\Settings\DocumentCategory;

use Illuminate\Foundation\Http\FormRequest;

class DocumentCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'required_student' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required_student.required' => 'Required Students is required!',
            'required_student.string' => 'Required Students must be a string!',
            'type.required' => 'Type is required!',
            'type.string' => 'Type must be a string!',
            'type.max' => 'Type must less than 255 characters!',
            'description.required' => 'Description is required!',
            'description.string' => 'Description must be a string!',
            'description.max' => 'Description must less than 255 characters!',
        ];
    }
}
