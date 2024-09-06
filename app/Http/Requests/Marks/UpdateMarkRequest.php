<?php

namespace App\Http\Requests\Marks;

use App\Models\Exam;
use App\Models\mark;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMarkRequest extends FormRequest
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
        $exam = Exam::find($this->route('mark')->exam_id);

        return [
            'student_class_id' => 'exists:student_classes,id',
            'earned_mark' => ['numeric', 'lte:' . ($exam->total_mark)]
        ];
    }

    protected function prepareForValidation()
    {
        $mark = mark::find($this->route('mark')->id);
        $this->merge([
            'can_update' => $this->canUpdateMark($mark)
        ]);
    }
    protected function canUpdateMark($mark)
    {
        $isAdmin = request()->user()->roles()->where('name', 'manager')->exists();
        $teacher_id = Exam::find($mark->exam_id)->teacher_id;
        $isAuth = request()->user()->id === $teacher_id;
        $oneDayPassed = Carbon::parse($mark->created_at)->addDay()->isPast();

        if (($isAuth && !$oneDayPassed) || $isAdmin)

            return true;

        return false;
    }
}
