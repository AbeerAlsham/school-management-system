<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Classes\Classroom;
use App\Models\Subjects\Subject;
use Illuminate\Http\Request;

class GetStudentsMarkDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //عرض الطلاب مع كامل علاماتهم الفصلية لشعبة معينة 
    public function __invoke(Request $request, Semester  $semester, Subject $subject, Classroom $classroom)
    {
        $marks = $classroom->studentClassrooms()
            ->with([
                'studentClass.student:id,photo,first_name,last_name',
                'studentClass.marks' => function ($query) use ($semester, $subject) {
                    $query->select('id', 'student_class_id', 'mark_type_id', 'test_name', 'earned_mark', 'total_mark')
                        ->where('semester_id', $semester->id)
                        ->where('subject_id', $subject->id);
                }
            ])->select('id', 'serial_number', 'student_class_id')->get();

        return $this->okResponse($marks, 'The marks retrieved successfully');
    }
}
