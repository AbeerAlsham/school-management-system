<?php

namespace App\Http\Requests\WeekPrograms;

use Illuminate\Foundation\Http\FormRequest;

class CreateWeekProgramRequest extends FormRequest
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
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,pdf',
            'classroom_id' => 'required|exists:classrooms,id',
        ];
    }
}
