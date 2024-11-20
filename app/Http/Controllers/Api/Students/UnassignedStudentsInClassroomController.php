<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Models\AssignmentStudent\studentClass;
use App\Models\Class\StudyClass;

use Illuminate\Http\Request;

class UnassignedStudentsInClassroomController extends Controller
{
    /**
     * عرض الطلاب الذين سجلوا ضمن صف معين لتعيينهم على الشعب الدراسية .
     */
    public function __invoke(Request $request,  StudyYear $studyYear, StudyClass $studyClass)
    {
        $studentClass = studentClass::with('student')
            ->where([
                ['study_year_id', '=', $studyYear->id],
                ['study_class_id', '=', $studyClass->id],
                ['status', '=', 'مسجل']
            ])
            ->whereDoesntHave('studentClassroom')
            ->get();

        return $this->okResponse($studentClass, 'studentClass have added successfully');
    }
}
