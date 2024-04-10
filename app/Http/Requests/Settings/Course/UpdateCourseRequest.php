<?php

namespace App\Http\Requests\Settings\Course;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'department_id' => 'required',
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ];

        $course = Course::find($this->id);

        if($course && $this->code != $course->code){
            $rules['code'] = 'required|string|max:255|unique:courses';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'department_id.required' => 'Course department is required!',
            'code.required' => 'Course code is required!',
            'code.string' => 'Course code  must be a string!',
            'code.max' => 'Course code  must less than 255 characters!',
            'code.unique' => 'Course code already exist!',
            'name.required' => 'Course name is required!',
            'name.string' => 'Course name must be a string!',
            'name.max' => 'Course name must less than 255 characters!',
        ];
    }
}
