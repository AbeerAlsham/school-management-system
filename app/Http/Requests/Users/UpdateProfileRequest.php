<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StudyLevel;
use App\Enums\University;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'min:4|max:255',
            'father_name' => 'min:4|max:255',
            'mother_name' => 'min:4|max:255',
            'last_name' => 'min:4|max:255',
            'national_number' => 'unique|integer|digits:11',
            'family_book_number'=>'integer',
            'specialist'=>'string',
            'study_level' =>'min:4|max:255|string' ,
            'university' =>'min:4|max:255|string',
        ];
    }
}
