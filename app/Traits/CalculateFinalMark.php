<?php

namespace App\Traits;

use NumberToWords\NumberToWords;

trait CalculateFinalMark
{
    public function calculateMarkDetails($data, $subject, $section)
    {

        $details = [];
        $totalsubjectEarned = 0;

        foreach ($data as $exam_type) {
            $totalEarnedMark = 0;
            $markCount = 0; // عدد السجلات

            foreach ($exam_type->exam as $exam) {
                foreach ($exam->marks as $mark) {
                    $totalEarnedMark += ($mark->earned_mark / $exam->total_mark);
                    $markCount += 1;
                }
            }

            // نسبة النوع من العلامة الكلية للمادة
            $typePercentage = $exam_type->percentage;

            // في حال وجود سجلات
            if ($markCount > 0) {
                if ($subject) {
                    $earnedMarkPercentage = ($totalEarnedMark / $markCount) * $typePercentage * $subject->max_mark;
                    $totalsubjectEarned += $earnedMarkPercentage;
                    $totalMarkPercentage = $typePercentage * $subject->max_mark;
                }
                if ($section) {
                    $earnedMarkPercentage = ($totalEarnedMark / $markCount) * $typePercentage * $section->max_mark;
                    $totalMarkPercentage = $typePercentage * $section->max_mark;
                }
            } else {
                // في حال عدم وجود سجلات لنوع العلامة
                $earnedMarkPercentage = 0;
                $totalMarkPercentage = $subject ? $typePercentage * $subject->max_mark : $typePercentage * $section->max_mark;
            }

            // حفظ تفاصيل النوع
            $details[$exam_type->name] = [
                'earned_mark_percentage' => round($earnedMarkPercentage),
                'total_mark_percentage' => $totalMarkPercentage
            ];
        }

        return [
            'details' => $details,
            'total_mark' =>round( $totalsubjectEarned)
        ];
    }
}
