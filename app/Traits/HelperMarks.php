<?php

namespace App\Traits;

trait HelperMarks
{
    public function addHelperMark($result_subjects)
    {
        $bonus_mark = 50;
        $exist_arabic = false;
        foreach ($result_subjects as  &$faild_subject) {
            if ($faild_subject['subject']->name === 'اللغة العربية') {
                $exist_arabic = true;
                //اختبرا اذا العلامات الناقصة عن اللغة العربية اكتر من 50
                $missing_mark = $faild_subject['subject']->min_mark - $faild_subject['details']['total_mark'];
                if ($missing_mark > $bonus_mark)
                    return [
                        'status' => 'راسب',
                        'result_subject' => null,
                    ]; // يبقى راسب]

                else {
                    $faild_subject['details']['status'] = 'ناجح';
                    $faild_subject['details']['mark_number'] .= ' + ' . $missing_mark;
                    $bonus_mark -= $missing_mark;
                }
            }
        }

        // حساب عدد المواد الراسبة
        $faild_subject_count = count(array_filter($result_subjects));
        $non_arabic_failed_count = $exist_arabic ? $faild_subject_count - 1 : $faild_subject_count;

        if ($non_arabic_failed_count > 2) {
            $this->sortFailedSubjects($result_subjects);
            // إضافة العلامات المساعدة للمواد الأخرى
            foreach ($result_subjects as &$faild_subject) {
                if ($faild_subject['subject']->name !== 'اللغة العربية') {
                    $missing_mark = $faild_subject['subject']->min_mark - $faild_subject['details']['mark_number'];

                    if ($missing_mark <= $bonus_mark) {
                        // إضافة العلامات المساعدة
                        $faild_subject['details']['mark_number'].= ' + ' . $missing_mark;
                        $bonus_mark -= $missing_mark;
                        $faild_subject['details']['status'] = 'ناجح';
                    }
                }
            }
        }

        // إعادة التحقق من المواد الراسبة بعد إضافة العلامات المساعدة
        $remaining_failed_subjects_count = 0;
        foreach ($result_subjects as &$faild_subject) {
            if ($faild_subject['subject']->name !== 'اللغة العربية' && $faild_subject['details']['mark_number'] < $faild_subject['subject']->min_mark) {
                $remaining_failed_subjects_count += 1;
            }
            // إذا كانت المواد الراسبة أكبر من 2
            if ($remaining_failed_subjects_count > 2) {
                return [
                    'status' => 'راسب',
                    'result_subject' => null,
                ]; // يبقى راسب
            } else
                return [
                    'status' =>'ناجح مع مساعدة',
                    'result_subject' => $result_subjects,
                    'helper_mark'=>$bonus_mark
                ];
        }
    }
    function sortFailedSubjects(&$failed_subjects)
    {
        usort($failed_subjects, function ($a, $b) {
            // Check if either subject is Arabic
            if ($a['subject']->name === 'اللغة العربية' && $b['subject']->name !== 'اللغة العربية') {
                return 1; // Put Arabic last
            } elseif ($a['subject']->name !== 'اللغة العربية' && $b['subject']->name === 'اللغة العربية') {
                return -1; // Put other subjects before Arabic
            }

            // If both subjects are not Arabic, calculate the missing mark
            $missing_a = $a['subject']->min_mark - $a['details']['mark_number'];
            $missing_b = $b['subject']->min_mark - $b['details']['mark_number'];

            // Sort in ascending order of missing marks
            return $missing_a <=> $missing_b;
        });
    }
}
