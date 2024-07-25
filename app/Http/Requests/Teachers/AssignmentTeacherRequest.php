<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentTeacherRequest extends FormRequest
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
            'semester_user_id' => 'exists:semester_users,id|required',
            'class_id' => 'exists:study_classes,id|required',
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id'=>'required|exists:subjects,id',
            'section_id'=>'nullable|exists:sections,id'
        ];
    }
}
