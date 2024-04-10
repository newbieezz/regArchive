<?php

namespace App\Http\Requests\Settings\Major;

use Illuminate\Foundation\Http\FormRequest;

class MajorRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'name.string' => 'Name must be a string!',
            'name.max' => 'Name must less than 255 characters!',
        ];
    }
}
