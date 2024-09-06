<?php

namespace App\Http\Requests\Exams;

use Illuminate\Foundation\Http\FormRequest;

class CreateExamRequest extends FormRequest
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
            'semester_id' => 'required|exists:semesters,id',
            'subject_id'=>'required|exists:subjects,id',
            'section_id'=>'somtimes|exists:sections,id',
            'classroom_id'=>'required|exists:classrooms,id',
            'test_name'=>'required|string|min:5|max:15',
            'exam_type_id'=>'required|exists:exam_types,id',
            'total_mark'=>'required|numeric|between:10,600'
        ];
    }
}
