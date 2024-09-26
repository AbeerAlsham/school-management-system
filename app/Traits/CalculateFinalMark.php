<?php

namespace App\Traits;
use App\Traits\CalculateMark;
trait CalculateFinalMark
{
    use CalculateMark;
    public function calculateMarkDetails($data, $subject, $section)
    {
        $sumWorkMarks= 0;
        $totalsubjectEarned = 0;
        $totalWorkMarks = [];
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

            // إذا كان هذا هو نوع الامتحان، احفظ علامة الامتحان بشكل منفصل
            if ($exam_type->name === 'امتحان الفصل') {
                $totalExamMarks= [
                    'earned_mark_percentage' => round($earnedMarkPercentage),
                    'total_mark_percentage' => $totalMarkPercentage
                ];
            } else {
                $sumWorkMarks+=round($earnedMarkPercentage);
                // أضف "درجة اعمال الطالب" كمفتاح
                $totalWorkMarks[$exam_type->name] = [
                    'earned_mark_percentage' => round($earnedMarkPercentage),
                    'total_mark_percentage' => $totalMarkPercentage
                ];
            }
        }
        return [
            'total_work_marks'=>$totalWorkMarks,
            'exam_mark'=>$totalExamMarks,
            'sum_work_marks'=>$sumWorkMarks,
            'total_mark' => $this->viewResult(round($totalsubjectEarned),$subject)
        ];
    }
}
