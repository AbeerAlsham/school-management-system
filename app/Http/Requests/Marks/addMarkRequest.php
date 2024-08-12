<?php

namespace App\Http\Requests\Marks;

use Illuminate\Foundation\Http\FormRequest;

class addMarkRequest extends FormRequest
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
            'marks.*.semester_id' => 'required|exists:semesters,id',
            'marks.*.total_mark' => 'required|numeric',
            'marks.*.mark_type_id' => 'integer|required|exists:mark_types,id',
            'marks.*.test_name' => 'required',
            'marks.*.subject_id' => 'required|exists:subjects,id',
            'marks.*.section_id' => 'exists:sections,id',
            'marks.*.student_class_id' => 'exists:student_classes,id',
            'marks.*.earned_mark' => 'required|numeric|digits_between:0,total_mark'

        ];
    }
}
