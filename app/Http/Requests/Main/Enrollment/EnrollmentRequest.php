<?php

namespace App\Http\Requests\Main\Enrollment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnrollmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'school_year_id' => 'required',
            'semester' => 'required',
            'department_id' => 'required',
            'course_id' => 'required',
            'year_level' => 'required',
            'student_status' => 'required',
            'section_id' => 'required',
            'student_id' => [
                'required',
                'integer',
                Rule::unique('enrollments')->where(function ($query) {
                    return $query->where('student_id', request('student_id'))
                        ->where('school_year_id', request('school_year_id'))
                        ->where('semester', request('semester'))
                        ->where('year_level', request('year_level'))
                        ->where('course_id', request('course_id'));
                }),
            ],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'home_address' => 'required|string|max:500',
            'city_address' => 'required|string|max:500',
            'contact_no' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'gender' => 'required',
            'birthdate' => 'required',
            'birth_address' => 'required|max:500',
            'citizenship' => 'required|max:255',
            'religion' => 'required|max:255',
            'civil_status' => 'required',
            'guardians_name' => 'required|max:255',
            'guardian_contact' => 'required|numeric',
            'required_document' => 'required|string|max:255',
        ];
    }

    
    public function messages()
    {
        return [
            'student_id.unique' => 'Student already enrolled on the enrollment information above',
        ];
    }
}
