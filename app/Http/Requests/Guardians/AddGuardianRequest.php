<?php

namespace App\Http\Requests\Guardians;

use App\Rules\uniquePhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AddGuardianRequest extends FormRequest
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
            'guardian.first_name' => 'required|min:3|max:255',
            'guardian.father_name' => 'required|min:3|max:255',
            'guardian.last_name' => 'required|min:3|max:255',
            'phone_numbers.*.phone_number'=>['digits:10','starts_with:09','unique:contact_numbers,phone_number',new uniquePhoneNumberRule()]
        ];
    }
}
