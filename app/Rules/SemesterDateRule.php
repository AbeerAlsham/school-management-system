<?php

namespace App\Rules;

use App\Models\AcademicYear\StudyYear;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Closure;

class SemesterDateRule implements ValidationRule
{
    protected $academicYearId;

    public function __construct($academicYearId)
    {
        $this->academicYearId = $academicYearId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $academicYear = StudyYear::find($this->academicYearId);

        $start_date = request('start_date');
        $end_date = request('end_date');
        $academic_year_start_date = $academicYear['start_date'];
        $academic_year_end_date = $academicYear['end_date'];

        if ($start_date && $start_date < $academic_year_start_date || $start_date > $academic_year_end_date) {
            $fail('تاريخ بداية الفصل الدراسي يجب أن يكون ضمن نطاق العام الدراسي.');
        }

        if ($end_date && $end_date < $academic_year_start_date || $end_date > $academic_year_end_date) {
            $fail('تاريخ نهاية الفصل الدراسي يجب أن يكون ضمن نطاق العام الدراسي.');
        }
    }
}
