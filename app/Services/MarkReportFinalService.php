<?php

namespace App\Services;

use App\Traits\{CalculateMark, CalculateFinalMark, HelperMarks};

class MarkReportFinalService
{
    use CalculateMark, CalculateFinalMark, HelperMarks;

    public function getMarksBySemester($studentClass, $studyYear)
    {
        $result = [];
        $semesterGeneralMarks = []; // لتخزين مجموع العلامات المكتسبة لكل فصل دراسي
        $semesterFinalMarks = []; // لتخزين مجموع العلامات النهائية لكل فصل دراسي
        $faild_subject = [];
        foreach ($studentClass->studyClass->subjects as $subject) {
            $sum2semester = 0;
            $exam_mark = [];
            $sum_work_marks = [];
            foreach ($studyYear->semesters as $semester) {
                // تهيئة المصفوفات إذا لم تكن موجودة
                $this->initializeSemesterMarks($semesterGeneralMarks, $semesterFinalMarks, $semester);
                $data = $this->loadMarks($studentClass, $semester, $subject);
                $markDetails = $this->calculateMarkDetails($data, $subject, null);
                $exam_mark[$semester->name] = $markDetails['exam_mark'];
                $sum_work_marks[$semester->name] = $markDetails['sum_work_marks'];
                $total_mark[$semester->name] = $markDetails['total_mark']; // تخزين العلامات لكل فصل
                $sum2semester += $markDetails['total_mark']['mark_number']; // (من أجل المحصلة)جمع العلامات

                // تحديث مجموع العلامات العامة والنهائية
                $this->updateSemesterMarks($semesterGeneralMarks, $semesterFinalMarks, $markDetails, $subject, $semester);
            }
            // تخزين النتائج النهائية للمادة
            $result[$subject->name] = $this->storeSubjectResults($exam_mark, $sum_work_marks, $total_mark, $sum2semester, $subject, $studyYear);
            $average = $result[$subject->name]['average'][0];
            if ($average['status'] === 'راسب') {
                $faild_subject[] = ['subject' => $subject, 'details' => $average];
            }
        }
        // حساب المعدلات النهائية والعامة
        [$sumFinalMark, $averageFinalMark, $sumGeneralMark, $averageGeneralMark] = $this->calculateFinalAndGeneralAverages($semesterFinalMarks, $semesterGeneralMarks, $studyYear);
        $result_with_helper_marks = $this->addHelperMark($faild_subject);
        //تحديث حالة المجموع العام و النهائي أي نجاح أو رسوب
        $averageFinalMark['status'] = $result_with_helper_marks['status'];
        $averageGeneralMark['status'] = $result_with_helper_marks['status'];
        //تحديث حالة الطالب ضمن السنة الدراسية
       $studentClass['status']= $result_with_helper_marks['status'];
        //إذا كان ناجح مع مساعدة يجب تحديث المجموع العام و النهائي
        if ($result_with_helper_marks['status'] == 'ناجح مع مساعدة') {
            $this->updateAfterAddeHelperMarks($result_with_helper_marks, $result);
            $averageFinalMark['mark_number'] .= '+' . $result_with_helper_marks['helper_mark'];
            $averageGeneralMark['mark_number'] .= '+' . $result_with_helper_marks['helper_mark'];
        }
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
            'status' => $result_with_helper_marks['status'],
        ];
    }

    private function initializeSemesterMarks(&$semesterGeneralMarks, &$semesterFinalMarks, $semester)
    {
        if (!isset($semesterGeneralMarks[$semester->name]['earned_mark'])) {
            $semesterGeneralMarks[$semester->name]['earned_mark'] = 0;
        }
        if (!isset($semesterGeneralMarks[$semester->name]['total_mark'])) {
            $semesterGeneralMarks[$semester->name]['total_mark'] = 0;
        }
        if (!isset($semesterFinalMarks[$semester->name]['earned_mark'])) {
            $semesterFinalMarks[$semester->name]['earned_mark'] = 0;
        }
        if (!isset($semesterFinalMarks[$semester->name]['total_mark'])) {
            $semesterFinalMarks[$semester->name]['total_mark'] = 0;
        }
    }

    private function updateSemesterMarks(&$semesterGeneralMarks, &$semesterFinalMarks, $markDetails, $subject, $semester)
    {
        if ($subject->name !== 'السلوك' && $subject->name !== 'التربية المهنية') {
            $semesterGeneralMarks[$semester->name]['earned_mark'] += $markDetails['total_mark']['mark_number'];
            $semesterGeneralMarks[$semester->name]['total_mark'] += $subject->max_mark;
        }
        $semesterFinalMarks[$semester->name]['earned_mark'] += $markDetails['total_mark']['mark_number'];
        $semesterFinalMarks[$semester->name]['total_mark'] += $subject->max_mark;
    }

    private function storeSubjectResults($exam_mark, $sum_work_marks, $total_mark, $sum2semester, $subject, $studyYear)
    {
        $average2semester = round($sum2semester / count($studyYear->semesters));
        return [
            'first_semester' => [
                'exam_mark' => $exam_mark[$studyYear->semesters[0]->name]['earned_mark_percentage'],
                'sum_work_marks' =>  $sum_work_marks[$studyYear->semesters[0]->name],
                'total_mark' => $total_mark[$studyYear->semesters[0]->name]
            ],
            'second_semester' => [
                'exam_mark' => $exam_mark[$studyYear->semesters[1]->name]['earned_mark_percentage'],
                'sum_work_marks' =>  $sum_work_marks[$studyYear->semesters[1]->name],
                'total_mark' => $total_mark[$studyYear->semesters[1]->name]
            ], // التعامل مع حالة عدم وجود فصل ثانٍ
            'sum' => $sum2semester,
            'average' => [
                $this->viewResult($average2semester, $subject)
            ]
        ];
    }

    private function calculateFinalAndGeneralAverages(&$semesterFinalMarks, &$semesterGeneralMarks, $studyYear)
    {
        $semesterFinalMarks[$studyYear->semesters[0]->name]['earned_mark'] = $this->viewResult($semesterFinalMarks[$studyYear->semesters[0]->name]['earned_mark'], null);
        $semesterFinalMarks[$studyYear->semesters[1]->name]['earned_mark'] = $this->viewResult($semesterFinalMarks[$studyYear->semesters[1]->name]['earned_mark'], null);
        $semesterGeneralMarks[$studyYear->semesters[0]->name]['earned_mark'] = $this->viewResult($semesterGeneralMarks[$studyYear->semesters[0]->name]['earned_mark'], null);
        $semesterGeneralMarks[$studyYear->semesters[1]->name]['earned_mark'] = $this->viewResult($semesterGeneralMarks[$studyYear->semesters[1]->name]['earned_mark'], null);
        $sumFinalMark = ($semesterFinalMarks[$studyYear->semesters[0]->name]['earned_mark']['mark_number'] + $semesterFinalMarks[$studyYear->semesters[1]->name]['earned_mark']['mark_number']);
        $averageFinalMark = $this->viewResult(round($sumFinalMark / 2), null);
        $sumGeneralMark = $semesterGeneralMarks[$studyYear->semesters[0]->name]['earned_mark']['mark_number'] + $semesterGeneralMarks[$studyYear->semesters[1]->name]['earned_mark']['mark_number'];
        $averageGeneralMark = $this->viewResult(round($sumGeneralMark / 2), null);

        return  [$sumFinalMark, $averageFinalMark, $sumGeneralMark, $averageGeneralMark];
    }

    private function updateAfterAddeHelperMarks($result_with_helper_marks, &$result)
    {
        foreach ($result_with_helper_marks['result_subject'] as $helper_subject) {
            $subject_name = $helper_subject['subject']->name;
            if (isset($result[$subject_name])) {
                $result[$subject_name]['average'][0]['status'] = $helper_subject['details']['status'];
                $result[$subject_name]['average'][0]['mark_number'] = $helper_subject['details']['mark_number'];
            }
        }
    }
}
