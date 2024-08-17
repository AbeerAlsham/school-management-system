<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Mark;
use App\Models\studentClass;
use App\Models\Subjects\Subject;
use Illuminate\Http\Request;
use App\Traits\CalculateFinalMark;

class showStudentMarkDetailsController extends Controller
{
    use CalculateFinalMark;
    /**
     * عرض علامات مفصلة لطالب معين من اجل مادة معينة
     * الشفهي و الوظائفو الامتحانات مع تفاصيلهم
     */
    public function __invoke(Request $request, Semester $semester, Subject $subject, studentClass $studentClass)
    {
        $marks = Mark::where('student_class_id', $studentClass->id)
            ->where('semester_id', $semester->id)
            ->where('subject_id', $subject->id)
            ->with('markType') // Assuming you have a relationship with mark types
            ->select('id', 'test_name', 'earned_mark', 'total_mark', 'mark_type_id')
            ->orderBy('mark_type_id')
            ->get();

        $marks_groups = $marks->groupBy('markType.name'); // Assuming mark type has a 'name' attribute
        $result = $this->calculateMarkDetails($marks_groups, $subject, null);
        return $this->okResponse(['marks' => $marks_groups, 'Statistics' => $result], 'the marks retrived successfully');
    }
}
