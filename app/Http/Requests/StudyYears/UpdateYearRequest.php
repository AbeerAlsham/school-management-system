<?php

namespace App\Http\Requests\StudyYears;

use Illuminate\Foundation\Http\FormRequest;

class UpdateYearRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'name' => 'string|min:8|max:255|unique:study_years,name',
            'startDate' => 'date',
            'endDate' => 'date|after:startDate',
            'is_opened' => 'boolean'
        ];
    }
}
