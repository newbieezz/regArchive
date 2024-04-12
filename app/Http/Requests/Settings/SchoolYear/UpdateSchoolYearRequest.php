<?php

namespace App\Http\Requests\Settings\SchoolYear;

use App\Models\SchoolYear;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolYearRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'year' => 'required|string|max:255',
        ];

        $schoolYear = SchoolYear::find($this->id);

        

        return $rules;
    }

    public function messages()
    {
        return [
            'year.required' => 'School year is required!',
            'year.string' => 'School year  must be a string!',
            'year.max' => 'School year  must less than 255 characters!',
        ];
    }
}
