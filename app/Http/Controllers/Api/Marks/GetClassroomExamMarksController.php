<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\Exam\Exam;
use Illuminate\Http\Request;

class GetClassroomExamMarksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // عرض علامات طلاب شعبة معينة حسب الاختبار
    public function __invoke(Request $request, Exam $exam)
    {
        $marks = $exam->classroom->studentClassrooms()
            ->with(['studentClass.student:id,first_name,last_name', 'studentClass.marks' => function ($query) use ($exam) {
                $query->where('exam_id', $exam->id);
            }])
            ->get();

        return $this->okResponse($marks, 'The marks retrieved successfully');
    }
}
