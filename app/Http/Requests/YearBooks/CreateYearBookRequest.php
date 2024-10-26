<?php

namespace App\Http\Requests\YearBooks;

use Illuminate\Foundation\Http\FormRequest;

class CreateYearBookRequest extends FormRequest
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
            'book_id' => 'exists:books,id|required',
            'study_year_id'=>'exists:study_years,id|required',
            'book_available_new'=>'required|integer',
            'book_avalilable_old'=>'required|integer',
        ];
    }
}
