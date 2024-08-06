<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
// use App\Enums\StudyLevel;
// use Illuminate\Validation\Rule;

class AddStudentRequest extends FormRequest
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'public_registry_number' => 'required|unique:students,public_registry_number',
            'first_name' => 'required|min:2|max:255|string',
            'last_name' => 'required|min:2|max:255|string',
            'birth_address' => 'required|min:4|max:255|string',
            'birthdate' => 'required|date|string',
            'registration_place' => 'required|min:4|max:255|string',
            'registration_number' => 'required|integer',
            'religion' => 'required|min:4|max:255|string',
            'nationality' => 'required|min:4|max:255|string',
            'chronic_diseases' => 'string',
            'national_number' => 'unique:students,national_number|required|digits:11|starts_with:0',

            'address.address' => 'required|min:4|max:255|string',
            'address.type' => 'required|string',
            'address.isLiveParent' => 'required',

            'father.name' => 'required|min:3|max:255|string',
            'father.parent_name' => 'required|min:4|max:255|string',
            'father.study_level' => 'required',
            'father.work' => 'required|min:4|max:255|string',

            'mother.name' => 'required|min:3|max:255|string',
            'mother.last_name' => 'required|min:4|max:255|string',
            'mother.study_level' => 'required',
            'mother.work' => 'required|min:4|max:255|string',

            'siblings.*.name' => 'required|min:3|max:255|string',
            'siblings.*.study_level' => 'required',

            'guardian.id' => 'exists:users,id|required',
            'guardian.kinship' => 'required|string',

            'enrollement.class_id' => 'exists:study_classes,id|required',
            'enrollement.document_date' => 'required|date',
            'enrollement.document_number' => 'required|integer',
            'enrollement.enrollment_date' => 'required|date',

            'lastSchool.school_name' => 'required',
            'lastSchool.school_address' => 'required',
            'lastSchool.previous_result' => 'required',
            'lastSchool.failed_grades' => 'nullable'
        ];
    }
}
