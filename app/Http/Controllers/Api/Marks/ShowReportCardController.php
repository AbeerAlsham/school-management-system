<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear\StudyYear;
use App\Models\AssignmentStudent\studentClass;
use App\Models\Student\Student;
use App\Services\MarkReportFinalService;
use App\Traits\CalculateFinalMark;
use App\Traits\CalculateAttendance;
use App\Traits\CalculateMark;

class ShowReportCardController extends Controller
{
    use CalculateFinalMark, CalculateAttendance, CalculateMark;

    /**
     * عرض الجلاء المدرسي للطالب
     */

    protected $markService;

    public function __construct(MarkReportFinalService  $markService)
    {
        $this->markService = $markService;
    }

    public function __invoke(Request $request, StudyYear $studyYear, studentClass $studentClass)
    {

        if ($studyYear->end_date > now())
            return $this->errorResponse('do not export card before the study year');

        $directoryPath = storage_path('app/marks');
        $filePath = $directoryPath . '/' . $studyYear->name . '_' . $studentClass->student->national_number . '.json';

        // تحقق من وجود المجلد، وإذا لم يكن موجودًا، قم بإنشائه
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
        if (file_exists($filePath)) {
            // استرجاع البيانات من الملف
            $results = json_decode(file_get_contents($filePath), true);
        } else {
            $results = [
                'student_details' => $student_details= $this->getStudent($studentClass),
                'marks' => $this->getMarksBySemester($studentClass, $studyYear),
               'attendance' => $this->getAttendance($studyYear, $student_details['student'])
            ];

            file_put_contents($filePath, json_encode($results));
        }

        return $this->okResponse($results);
    }

    public function getAttendance(StudyYear $studyYear, Student $student)
    {

        $attendances = [];
        foreach ($studyYear->semesters as $semester) {
            $attendances[$semester->name] = [
                $this->calculateAttendanceCount($semester, $student)
            ];
        }
        return $attendances;
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

    public function getMarksBySemester(StudentClass $studentClass, StudyYear $studyYear)
    {
        return $this->markService->getMarksBySemester($studentClass, $studyYear);
    }
}
