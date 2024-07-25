<?php

namespace App\Http\Requests\StudyYears;

use App\Rules\SemesterDateRule;
use Illuminate\Foundation\Http\FormRequest;

class updateSemesterRequest extends FormRequest
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
        $rules = [
            'name' => 'string|min:8|max:255',
        ];

        if ($this->has('start_date') && !$this->has('end_date')) {
            $rules['start_date'] = ['date', new SemesterDateRule($this->route('semester')->year_id)];
        } elseif ($this->has('end_date') && !$this->has('start_date')) {
            $rules['end_date'] = ['date', 'after:start_date', new SemesterDateRule($this->route('semester')->year_id)];
        } elseif ($this->has('start_date') && $this->has('end_date')) {
            $rules['start_date'] = ['date', new SemesterDateRule($this->route('semester')->year_id)];
            $rules['end_date'] = ['date', 'after:start_date', new SemesterDateRule($this->route('semester')->year_id)];
        }

        return $rules;
    }
}
