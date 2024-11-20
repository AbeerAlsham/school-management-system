<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Class\Classroom;
use App\Models\Exam\ExamType;
use App\Models\Subject\Subject;
use Illuminate\Http\Request;
use App\Traits\CalculateFinalMark;

class ShowClassroomMarksController extends Controller
{
    use CalculateFinalMark;
    /**
     * عرض محصلات مادة معينة لشعبة معينة ضمن فصل دراسي معين
     */
    public function __invoke(Request $request)
    {
        $classroom = Classroom::find($request->classromm->id);
        $studentsClassroom = $classroom->studentClassrooms;
        $subject = Subject::find($request->subject_id);
        foreach ($studentsClassroom as $studentClassroom) {
            $marks = ExamType::with(
                ['exam' => function ($query) use ($request, $studentClassroom) {
                    $query->where('semester_id', $request->semester_id)
                        ->where('subject_id', $request->subject_id)
                        ->where('classroom_id', $request->section_id)
                        ->with(['marks' => function ($query) use ($studentClassroom) {
                            $query->where('student_class_id', $studentClassroom->studentClass->id);
                        }]);
                }]
            )->get();
            $result = $this->calculateMarkDetails($marks,  $subject, null);
            $details_student[] = [
                'student' =>  $studentClassroom->studentClass->student,
                'marks' => $result
            ];
        }
        $result = [
            'classrom' => $classroom,
            'semester' => Semester::find($request->semester_id),
            'subject' => $subject,
            'students with marks' => $details_student
        ];

        return $this->okResponse(['final_result' => $result], 'the marks retrived successfully');
    }
}
