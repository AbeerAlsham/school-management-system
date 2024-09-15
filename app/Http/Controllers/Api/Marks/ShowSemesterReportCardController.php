<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use Illuminate\Http\Request;
use App\Models\AcademicYear\StudyYear;
use App\Models\studentClass;
use App\Models\Students\Student;
use App\Traits\CalculateFinalMark;
use App\Traits\CalculateAttendance;
use App\Traits\CalculateMark;


class ShowSemesterReportCardController extends Controller
{
    use CalculateFinalMark, CalculateAttendance, CalculateMark;

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
                'student' => $student = $this->getStudent($studentClass),
                'class' => $this->getClass($studentClass),
                'classroom' => $this->getClassroom($studentClass),
                'marks' => $this->getMarksBySemester($studentClass, $semester),
                'attendance' => $this->getAttendance($semester, $student)
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
        return $studentClass->student()->with(['mother:id,name,student_id', 'father:id,name,student_id'])->select(['id', 'first_name', 'last_name'])->first();
    }

    public function getClass($studentClass)
    {

        return $studentClass->studyClass;
    }

    public function getClassroom($studentClass)
    {
        return $studentClass->studentClassroom()->with('classroom')->first();
    }


    public function getMarksBySemester($studentClass, $semester)
    {
    //     $result = [];

    //     foreach ($studentClass->studyClass->subjects as $subject) {

    //         $data = $this->loadMarks($studentClass, $semester, $subject);
    //         // حساب تفاصيل العلامات
    //         $markDetails = $this->calculateMarkDetails($data, $subject, null);

    //         $result[$subject->name] = [
    //             'semester' =>  $markDetails['details'],
    //             'total_mark' => $this->viewResult($markDetails['total_mark'], $subject)
    //         ];
    //     }
        // return $result;
    }
}
