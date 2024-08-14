<?php

namespace App\Http\Requests\Attendences;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
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
            'semester_id' => 'exists:semesters,id',
            'student_id' => 'exists:students,id',
            'date' => 'date',
            'status' => 'in:حاضر,غائب',
            'is_justified' => 'boolean|required_if:status,غائب',
            'note' => 'required_if:status,غائب'
        ];
    }
}
