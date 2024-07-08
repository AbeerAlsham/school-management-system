<?php

namespace App\Http\Requests\StudyYears;

use Illuminate\Foundation\Http\FormRequest;

class CreateYearRequest extends FormRequest
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
            'name'=>'required|string|min:8|max:255',
            'startDate'=>'required|date',
            'endDate'=>'required|date|after:startDate',

            'semesters.*.name'=>'required|string|min:8|max:255',
            'semesters.*.startDate'=>'required|date',
            'semesters.*.endDate'=>'required|date|after:startDate',

        ];
    }
}
