<?php

namespace App\Traits;

use NumberToWords\NumberToWords;

trait CalculateFinalMark
{
    public function calculateMarkDetails($marks, $subject, $section)
    {
        // جلب جميع أنواع العلامات المتوقعة
        $allMarkTypes = \App\Models\MarkType::all()->pluck('name');
        // تعريف مصفوفة لحفظ تفاصيل العلامات
        $details = [];
        $totalsubjectEarned = 0;
        // مع ملاحظة انه يجب ارسال السجلات مجمعة حسب نوع العلامة
        foreach ($allMarkTypes as $type) {

            $totalEarnedMark = 0;
            $totalTypeMark = 0;
            $markCount = 0; // عدد السجلات

            if (isset($marks[$type])) {
                $marksGroup = $marks[$type];

                // حساب النسبة لكل سجل
                foreach ($marksGroup as $mark) {
                    $totalEarnedMark += ($mark->earned_mark / $mark->total_mark);
                    $markCount += 1;
                }

                // نسبة النوع من العلامة الكلية للمادة
                $typePercentage = $marksGroup->first()->markType->percentage;

                // في حال وجود سجلات
                if ($markCount > 0) {
                    if ($subject) {
                        $earnedMarkPercentage = ($totalEarnedMark / $markCount) * $typePercentage * $subject->max_mark;
                        $totalsubjectEarned += $earnedMarkPercentage;
                        $totalMarkPercentage = $typePercentage * $subject->max_mark;
                    }
                    if ($section) {
                        $earnedMarkPercentage = ($totalEarnedMark / $markCount) * $typePercentage * $section->max_mark;
                        $totalMarkPercentage =  $totalTypeMark * $typePercentage * $subject->max_mark;
                    }
                }
            } else {
                // في حال عدم وجود سجلات لنوع العلامة
                $earnedMarkPercentage = 0;
                $typePercentage = \App\Models\MarkType::where('name', $type)->first()->percentage;
                $totalMarkPercentage = $subject ? $typePercentage * $subject->max_mark : $typePercentage * $section->max_mark;
            }

            // حفظ تفاصيل النوع
            $details[$type] = [
                // 'type_name' => $type,
                'earned_mark_percentage' => round($earnedMarkPercentage),
                'total_mark_percentage' => $totalMarkPercentage
            ];
        }

        $status = ''; // إعلان $status قبل if statement

        if (!$section) {
            if ($totalsubjectEarned > $subject->min_mark) {
                $status = 'ناجح';
            } else {
                $status = 'راسب';
            }
        }


        // create the number to words "manager" class
        $numberToWords = new NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer('ar');

        return [$details, 'total_mark' => [
            'mark_number' => round($totalsubjectEarned),
            'mark_word' => $numberTransformer->toWords($totalsubjectEarned),
            'status' => $status
        ]];
    }
}
