<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class AssignClassStudentsRequest extends FormRequest
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
            'student_ids' => 'required|array',
            'student_ids.*'=>'integer|exists:students,id',
            'study_class_id' => 'required|exists:study_classes,id',
            'study_year_id' => 'required|exists:study_years,id',
        ];
    }
}
