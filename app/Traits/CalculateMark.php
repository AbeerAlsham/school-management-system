<?php

namespace App\Traits;

use App\Models\ExamType;
use NumberToWords\NumberToWords;

trait CalculateMark
{
    public function loadMarks($studentClass, $semester, $subject)
    {
        return ExamType::with(['exam' => function ($query) use ($studentClass, $semester, $subject) {
            $query->where('semester_id', $semester->id)
                ->where('subject_id', $subject->id)
                ->with(['marks' => function ($query) use ($studentClass) {
                    $query->where('student_class_id', $studentClass->id);
                }]);
        }])->get();
    }

    public function viewResult($totalsubjectEarned, $subject)
    {
        $status = ''; // إعلان $status قبل if statement

        if ($subject) {
            if ($totalsubjectEarned > $subject->min_mark) {
                $status = 'ناجح';
            } else {
                $status = 'راسب';
            }
        }
        return [
            'mark_number' => $totalsubjectEarned,
            'mark_word' => $this->convertToAR($totalsubjectEarned),
            'status' => $status
        ];
    }

    public function convertToAR($value)
    {
        // create the number to words "manager" class
        $numberToWords = new NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer('ar');

        return $numberTransformer->toWords($value);
    }
}
