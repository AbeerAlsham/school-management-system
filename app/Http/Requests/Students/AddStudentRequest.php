<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StudyLevel;
use Illuminate\Validation\Rule;

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
            'image' => 'nullable',
            'public_registry_number' => 'required|unique',
            'first_name' => 'required|min:2|max:255|string',
            'last_name' => 'required|min:2|max:255|string',
            'birth_address' => 'required|min:4|max:255|string',
            'birthdate' => 'required|date|string',
            'registration_place' => 'required|min:4|max:255|string',
            'registration_number' => 'required|integer',
            'religion' => 'required|min:4|max:255|string',
            'nationality' => 'required|min:4|max:255|string',
            'chronic_diseases' => 'nullable|string',
            'national_number' => 'unique|required|integer',

            'address.address' => 'required|min:4|max:255|string',
            'address.type' => 'required|string',
            'address.isLiveParent'=>'required|boolean',

            'father.name' => 'required|min:4|max:255|string',
            'father.parent_name' => 'required|min:4|max:255|string',
            'father.study_level' => 'required', Rule::enum(StudyLevel::class),
            'father.work' => 'required|min:4|max:255|string',

            'mother.name' => 'required|min:4|max:255|string',
            'mother.last_name' => 'required|min:4|max:255|string',
            'mother.study_level' => 'required', Rule::enum(StudyLevel::class),
            'mother.work' => 'required|min:4|max:255|string',

            'siblings.*.name' => 'required|min:4|max:255|string',
            'siblings.*.study_level' => 'required', Rule::enum(StudyLevel::class),
        ];
    }
}
