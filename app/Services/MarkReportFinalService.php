<?php
namespace App\Services;

use App\Traits\{CalculateMark, CalculateFinalMark};

class MarkReportFinalService
{
    use CalculateMark, CalculateFinalMark;

    public function getMarksBySemester($studentClass, $studyYear)
    {
        $result = [];
        $semesterGeneralMarks = []; // لتخزين مجموع العلامات المكتسبة لكل فصل دراسي
        $semesterFinalMarks = []; // لتخزين مجموع العلامات النهائية لكل فصل دراسي
        $subjectTotalMarks = 0; // من أجل حساب المجمو الكلي للجلاء

        foreach ($studentClass->studyClass->subjects as $subject) {
            $sum2semester = 0;
            $subjectTotalMarks += $subject->max_mark; // م

            foreach ($studyYear->semesters as $semester) {
                // تهيئة المصفوفات إذا لم تكن موجودة
                $this->initializeSemesterMarks($semesterGeneralMarks, $semesterFinalMarks, $semester);

                $data = $this->loadMarks($studentClass, $semester, $subject);
                $markDetails = $this->calculateMarkDetails($data, $subject, null);

                // الوصول إلى التفاصيل
                $details[$semester->name] = $markDetails['details'];
                $total_mark[$semester->name] = $markDetails['total_mark']; // تخزين العلامات لكل فصل
                $sum2semester += $markDetails['total_mark']; // (من أجل المحصلة)جمع العلامات

                // تحديث مجموع العلامات العامة والنهائية
                $this->updateSemesterMarks($semesterGeneralMarks, $semesterFinalMarks, $markDetails, $subject, $semester);
            }
            // تخزين النتائج النهائية للمادة
            $result[$subject->name] = $this->storeSubjectResults($details, $total_mark, $sum2semester, $subject, $studyYear);
        }

        // حساب المعدلات النهائية والعامة
        [$sumFinalMark, $averageFinalMark, $sumGeneralMark, $averageGeneralMark] = $this->calculateFinalAndGeneralAverages($semesterFinalMarks, $semesterGeneralMarks, $studyYear);

        return [
            'detail_mark' => $result,
            'general_earned_marks' => [
                'detail_earned_mark' => $semesterGeneralMarks,
                'sum' => $sumGeneralMark,
                'average' => $averageGeneralMark
            ],
            'final_earned_marks' => [
                'detail_earned_mark' => $semesterFinalMarks,
                'sum' => $sumFinalMark,
                'average' => $averageFinalMark
            ],
            'marks_total' => $subjectTotalMarks
        ];
    }

    private function initializeSemesterMarks(&$semesterGeneralMarks, &$semesterFinalMarks, $semester)
    {
        if (!isset($semesterGeneralMarks[$semester->name])) {
            $semesterGeneralMarks[$semester->name] = 0;
        }
        if (!isset($semesterFinalMarks[$semester->name])) {
            $semesterFinalMarks[$semester->name] = 0;
        }
    }

    private function updateSemesterMarks(&$semesterGeneralMarks, &$semesterFinalMarks, $markDetails, $subject, $semester)
    {
        if ($subject->name !== 'السلوك' && $subject->name !== 'التربية المهنية') {
            $semesterGeneralMarks[$semester->name] += $markDetails['total_mark'];
        }
        $semesterFinalMarks[$semester->name] += $markDetails['total_mark'];
    }

    private function storeSubjectResults($details, $total_mark, $sum2semester, $subject, $studyYear)
    {
        $average2semester = round($sum2semester / count($studyYear->semesters));
        return [
            'first_semester' => [
                $details[$studyYear->semesters[0]->name],
                $this->viewResult($total_mark[$studyYear->semesters[0]->name], $subject)
            ],
            'second_semester' => [
                $details[$studyYear->semesters[1]->name],
                $this->viewResult($total_mark[$studyYear->semesters[1]->name], $subject)
            ], // التعامل مع حالة عدم وجود فصل ثانٍ
            'sum' => $sum2semester,
            'average' => [
                $this->viewResult($average2semester, $subject)
            ]
        ];
    }

    private function calculateFinalAndGeneralAverages(&$semesterFinalMarks, &$semesterGeneralMarks, $studyYear)
    {
        $semesterFinalMarks[$studyYear->semesters[0]->name] = $this->viewResult($semesterFinalMarks[$studyYear->semesters[0]->name], null);
        $semesterFinalMarks[$studyYear->semesters[1]->name] = $this->viewResult($semesterFinalMarks[$studyYear->semesters[1]->name], null);
        $semesterGeneralMarks[$studyYear->semesters[0]->name] = $this->viewResult($semesterGeneralMarks[$studyYear->semesters[0]->name], null);
        $semesterGeneralMarks[$studyYear->semesters[1]->name] = $this->viewResult($semesterGeneralMarks[$studyYear->semesters[1]->name], null);
        $sumFinalMark = ($semesterFinalMarks[$studyYear->semesters[0]->name]['mark_number'] + $semesterFinalMarks[$studyYear->semesters[1]->name]['mark_number']);
        $averageFinalMark = $this->viewResult(round($sumFinalMark / 2), null);
        $sumGeneralMark = $semesterGeneralMarks[$studyYear->semesters[0]->name]['mark_number'] + $semesterGeneralMarks[$studyYear->semesters[1]->name]['mark_number'];
        $averageGeneralMark = $this->viewResult(round($sumGeneralMark / 2), null);

        return  [$sumFinalMark, $averageFinalMark, $sumGeneralMark, $averageGeneralMark];
    }

}
