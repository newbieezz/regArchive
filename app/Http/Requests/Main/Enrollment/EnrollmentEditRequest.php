<?php

namespace App\Http\Requests\Main\Enrollment;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentEditRequest extends FormRequest
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
            'student_id' => 'required|integer',
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
        ];
    }

}
