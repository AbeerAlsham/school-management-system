<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SameAcademicYearRule;

class AssignClassroomStudentsRequest extends FormRequest
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
            'student_class_ids' => 'required|array',
            'student_class_ids.*' =>[ 'exists:student_classes,id',new SameAcademicYearRule()],
            'classroom_id'=>'required|exists:classrooms,id'
        ];
    }
}
