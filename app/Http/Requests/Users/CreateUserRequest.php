<?php

namespace App\Http\Requests\Users;

use App\Rules\uniquePhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
            'username' => 'required|unique:users,username|min:4|max:255',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'profile.first_name' => 'required|min:4|max:255',
            'profile.father_name' => 'required|min:4|max:255',
            'profile.mother_name' => 'required|min:4|max:255',
            'profile.last_name' => 'required|min:4|max:255',
            'profile.study_level' => 'required',
            'profile.university' => 'required',
            'profile.specialist'=>'string|required',
            'profile.national_number' => 'unique:profiles,national_number|required|digits:11',
            'profile.family_book_number'=>'required|integer',
            'roleIds.*' => 'integer|exists:roles,id',
            'phone_numbers.*.phone_number'=>['digits:10','starts_with:09','unique:contact_numbers,phone_number',new uniquePhoneNumberRule()]
        ];
    }
}
