<?php

namespace App\Http\Requests\BooksDeliveries;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookDeliveryRequest extends FormRequest
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
            'book_deliveries' => 'required|array',
            'book_deliveries.*.student_class_id'=>'exists:student_classes,id',

        ];
    }
}
