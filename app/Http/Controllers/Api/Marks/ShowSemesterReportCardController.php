<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\AssignmentStudent\studentClass;
use App\Models\Student\Student ;
use Illuminate\Http\Request;
use App\Traits\CalculateFinalMark;
use App\Traits\CalculateAttendance;
use App\Traits\CalculateMark;
use App\Traits\HelperMarks;

class ShowSemesterReportCardController extends Controller
{
    use CalculateFinalMark, CalculateAttendance, CalculateMark, HelperMarks;

    /**
     * عرض الجلاء المدرسي للطالب
     */
    public function __invoke(Request $request, Semester $semester, studentClass $studentClass)
    {

        if ($semester->end_date > now())
            return $this->errorResponse('do not export card before the study year');

        $directoryPath = storage_path('app/marks');
        $filePath = $directoryPath . '/' . $semester->name . '_' . $studentClass->student->national_number . '.json';

        // تحقق من وجود المجلد، وإذا لم يكن موجودًا، قم بإنشائه
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
        if (file_exists($filePath)) {
            // استرجاع البيانات من الملف
            $results = json_decode(file_get_contents($filePath), true);
        } else {
        $results = [
            'student_details' => $student_details = $this->getStudent($studentClass),
            'marks' => $this->getMarksBySemester($studentClass, $semester),
            'attendance' => $this->getAttendance($semester, $student_details['student'])
        ];

        file_put_contents($filePath, json_encode($results));
        }

        return $this->okResponse($results);
    }

    public function getAttendance(Semester $semester, Student $student)
    {
        $attendances = [];

        return  $attendances[$semester->name] = [
            $this->calculateAttendanceCount($semester, $student)
        ];
    }

    public function getStudent($studentClass)
    {
        return $studentClass
            ->with([
                'student' => function ($query) {
                    $query->with([
                        'mother:id,name,student_id',
                        'father:id,name,student_id',
                    ])->select(['id', 'first_name', 'last_name']);
                },
                'studyClass',
                'studentClassroom.classroom',
            ])->first();
    }

    public function getMarksBySemester($studentClass, $semester)
    {
        $result = [];
        $GeneralMarks = ['earned_mark' => 0, 'total_mark' => 0]; // لتخزين مجموع العلامات المكتسبة ل فصل دراسي
        $FinalMarks = ['earned_mark' => 0, 'total_mark' => 0]; // لتخزين مجموع العلامات النهائية ل فصل دراسي

        foreach ($studentClass->studyClass->subjects as $subject) {
            $data = $this->loadMarks($studentClass, $semester, $subject);
            // حساب تفاصيل العلامات
            $markDetails = $this->calculateMarkDetails($data, $subject, null);

            if ($subject->name !== 'السلوك' && $subject->name !== 'التربية المهنية') {
                $GeneralMarks['earned_mark'] += $markDetails['total_mark']['mark_number'];
                $GeneralMarks['total_mark'] += $subject->max_mark;
            }

            $FinalMarks['earned_mark'] += $markDetails['total_mark']['mark_number'];
            $FinalMarks['total_mark'] += $subject->max_mark;

            $result[$subject->name] = [
                'total_exam_mark' =>  $markDetails['exam_mark']['earned_mark_percentage'],
                'sum_work_marks' => $markDetails['sum_work_marks'],
                'total_mark' => $markDetails['total_mark'],
            ];
        }
        $GeneralMarks['earned_mark'] = $this->viewResult($GeneralMarks['earned_mark'], null);
        $FinalMarks['earned_mark'] = $this->viewResult($FinalMarks['earned_mark'], null);
        return [
            'subjects_marks' => $result,
            'general_earned_marks' => $GeneralMarks,
            'final_earned_marks' => $FinalMarks,
        ];
    }
}
