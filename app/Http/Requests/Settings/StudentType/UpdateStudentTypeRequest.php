<?php

namespace App\Http\Requests\Settings\StudentType;

use App\Models\StudentType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'letter_tag' => 'required|string|max:255',
        ];

        $studentType = StudentType::find($this->id);

        

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Section name is required!',
            'name.string' => 'Section name  must be a string!',
            'name.max' => 'Section name  must less than 255 characters!',
            'letter_tag.required' => 'Section sched is required!',
            'letter_tag.string' => 'Section sched  must be a string!',
            'letter_tag.max' => 'Section sched  must less than 255 characters!',
        ];
    }
}
