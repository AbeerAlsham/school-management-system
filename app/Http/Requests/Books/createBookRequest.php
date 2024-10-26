<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class createBookRequest extends FormRequest
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
            'books' => 'array|required',
            'books.*.title' => 'required|string',
            'books.*.is_yearly' => 'required|boolean',
        ];
    }
}
