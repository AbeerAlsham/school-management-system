<?php

namespace App\Http\Requests\Attendences;

use Illuminate\Foundation\Http\FormRequest;

class AddAttendanceRequest extends FormRequest
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
            'attendances.*.semester_id' => 'exists:semesters,id|required',
            'attendances.*.student_id' => 'required|exists:students,id',
            'attendances.*.date' => 'required|date',
            'attendances.*.status' => 'required|in:حاضر,غائب',
            'attendances.*.is_justified' => 'boolean|required_if:attendances.*.status,غائب',
            'attendances.*.notes' => 'required_if:attendances.*.status,غائب'
        ];
    }
}
