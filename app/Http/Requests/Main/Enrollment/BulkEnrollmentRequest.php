<?php

namespace App\Http\Requests\Main\Enrollment;

use Illuminate\Foundation\Http\FormRequest;

class BulkEnrollmentRequest extends FormRequest
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
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ];
    }

}
