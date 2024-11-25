<?php

namespace App\Http\Requests\Subjects;

use Illuminate\Foundation\Http\FormRequest;

class AddSectionRequest extends FormRequest
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
        $mark_subject = $this->subject->max_mark;
        return [
            'name' => 'required|string|min:2|max:20|unique:sections,name',
            'max_mark' => ['required', 'integer', 'gt:0', 'lt:' . $mark_subject,]
        ];
    }
}
