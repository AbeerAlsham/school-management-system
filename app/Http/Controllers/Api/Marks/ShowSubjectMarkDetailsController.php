<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\Exam\ExamType;
use App\Models\Subject\Section;
use App\Models\Subject\Subject;
use Illuminate\Http\Request;
use App\Traits\CalculateFinalMark;

class ShowSubjectMarkDetailsController extends Controller
{
    use CalculateFinalMark;
    /*عرض علامات مفصلة لطالب معين من اجل مادة معينة
     * الشفهي و الوظائفو الامتحانات مع تفاصيلهم
     */
    public function __invoke(Request $request)
    {
        $marks = ExamType::whereHas('exam', function ($query) use ($request) {
            $query->where('semester_id', $request->semester_id)
                ->where('subject_id', $request->subject_id)
                ->where('section_id', $request->section_id);
        })->with(['exam' => function ($query) use ($request) {
            $query->where('semester_id', $request->semester_id)
                ->where('subject_id', $request->subject_id)
                ->where('section_id', $request->section_id)
                ->with(['marks' => function ($query) use ($request) {
                    $query->where('student_class_id', $request->studentClass_id);
                }]);
        }])->get();

        $subject = Subject::find($request->subject_id);
        $section = Section::find($request->section_id);
        $result = $this->calculateMarkDetails($marks,  $subject,  $section);
        return $this->okResponse(['exams with marks' => $marks, 'final_result' => $result], 'the marks retrived successfully');
    }
}
