<?php

namespace App\Http\Requests\Settings\Section;

use Illuminate\Foundation\Http\FormRequest;

class CreateSectionRequest extends FormRequest
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
            'sched' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Section name is required!',
            'name.string' => 'Section name  must be a string!',
            'name.max' => 'Section name  must less than 255 characters!',
            'sched.required' => 'Section sched is required!',
            'sched.string' => 'Section sched  must be a string!',
            'sched.max' => 'Section sched  must less than 255 characters!',
        ];
    }
}
