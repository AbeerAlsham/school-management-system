<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Models\Exam\Exam;
use Illuminate\Http\Request;

class ShowSubjectExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //عرض امتحانات مادة معينة بحسب فصل معين (الآدمن)
    public function __invoke(Request $request)
    {
        if ($request->has('semester_id') && ($request->has('subject_id') || $request->has('section_id')) && $request->has('classroom_id')) {
            $exams = Exam::with('examType', 'semesterUser.userRole.user.profile:first_name,last_name')->where('semester_id', $request->semester_id)
                ->where('classroom_id', $request->classroom_id)
                ->when($request->has('section_id'), function ($query) use ($request) {
                    // إذا كان section_id موجودًا، يتم استخدامه فقط
                    $query->where('section_id', $request->section_id);
                }, function ($query) use ($request) {
                    // إذا لم يكن section_id موجودًا، يتم استخدام subject_id
                    if ($request->has('subject_id')) {
                        $query->where('subject_id', $request->subject_id);
                    }
                })->when($request->has('exam_type_id'), function ($query) use ($request) {
                    // فلترة الاختبارات بحسب نوع الاختبار
                    $query->where('exam_type_id', $request->exam_type_id);
                })
                ->get();
            return $this->okResponse($exams, 'the exams retrived successfully');
        }
    }
}
