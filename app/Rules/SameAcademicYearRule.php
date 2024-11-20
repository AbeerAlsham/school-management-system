<?php

namespace App\Rules;

use App\Models\AssignmentStudent\studentClass;
use App\Models\Class\Classroom;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SameAcademicYearRule implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $classroom = Classroom::find(request('classroom_id'));
        $studentClass = studentClass::find($value);
        if (!$classroom || !$studentClass || $classroom->year_id !== $studentClass->study_year_id) {
            $fail('The academic year of the classroom must match the academic year of the student class.');
        }
    }
}
