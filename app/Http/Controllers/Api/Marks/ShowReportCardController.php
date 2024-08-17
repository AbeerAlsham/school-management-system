<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear\StudyYear;
use App\Models\Mark;
use App\Models\studentClass;
use App\Traits\CalculateFinalMark;
use App\Traits\CalculateAttendance;

class ShowReportCardController extends Controller
{
    use CalculateFinalMark, CalculateAttendance;

    /**
     * عرض الجلاء المدرسي للطالب
     */
    public function __invoke(Request $request, StudyYear $studyYear, studentClass $studentClass)
    {
        $student = $this->getStudent($studentClass);
        $class = $this->getClass($studentClass);
        $classroom = $this->getClassroom($studentClass);
        $marks = $this->getMarksBySemester($studentClass);
        $attendance = $this->getAttendance($studyYear, $student);

        return $this->okResponse(
            [
                'student' => $student,
                'class' => $class,
                'classroom' => $classroom,
                'marks' => $marks,
                'attendance' => $attendance
            ]

        );
    }

    public function getAttendance($studyYear, $student)
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
        return $studentClass->student()->with(['mother', 'father'])->first();
    }

    public function getClass($studentClass)
    {
        return $studentClass->class;
    }

    public function getClassroom($studentClass)
    {
        return $studentClass->studentClassroom()->with('classroom')->first();
    }

    public function getMarksBySemester($studentClass)
    {
        $marks = Mark::where('student_class_id', $studentClass->id)
            ->with(['markType:id,name', 'subject:id,name', 'semester:id,name'])
            ->select('id', 'test_name', 'earned_mark', 'total_mark', 'mark_type_id', 'semester_id', 'subject_id')
            ->get()
            ->groupBy(['semester.name', 'subject.id', 'markType.name']);

        $results = [];

        foreach ($marks as $semesterName => $subjects) {
            foreach ($subjects as $subjectId => $markTypes) {
                foreach ($markTypes as $markTypeName => $marks) {
                    $result = $this->calculateMarkDetails($marks, $subjectId, $markTypeName);
                    $results[$semesterName][$subjectId][$markTypeName] = $result;
                }
            }
        }
        return $result;
    }
}
