<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use App\Models\Class\StudyClass;
use App\Models\Student\Student;
use Illuminate\Http\Request;

class GetStudentStudyResult extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Student $student)
    {
        $result = StudyClass::with(['studentClasses' => function ($query) use ($student) {
            $query->where('student_id', $student->id);
        }, 'studentClasses.studyYear:id,name'])->get();

        return $this->okResponse($result, 'the study result retrieved');
    }
}
