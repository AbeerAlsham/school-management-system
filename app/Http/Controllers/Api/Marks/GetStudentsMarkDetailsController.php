<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Classes\Classroom;
use App\Models\Exam;
use App\Models\studentClass;
use App\Models\Subjects\Subject;
use Illuminate\Http\Request;

class GetStudentsMarkDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //عرض الطلاب مع كامل علاماتهم الفصلية لشعبة معينة
    public function __invoke(Request $request, Exam $exam, Classroom $classroom)
    {
        $marks = $classroom->studentClassrooms->studentClass->with('marks', 'students');

        // $marks = $exam->marks()
        //     ->where('classroom_id', $classroom->id)
        //     ->with(['studentClass.student'])
        //     ->get();

        return $this->okResponse($marks, 'The marks retrieved successfully');
    }
}
