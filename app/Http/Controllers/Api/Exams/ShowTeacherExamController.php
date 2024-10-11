<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ShowTeacherExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //تتم عن طريق ال auth
    public function __invoke(Request $request)
    {
        if ($request->has('semester_user_id') && $request->has('classroom_id')) {
            $exams = Exam::with('examType')
                ->where('semester_user_id', $request->semester_user_id)
                ->where('classroom_id', $request->classroom_id)
                ->when($request->has('section_id'), function ($query) use ($request) {
                    // إذا كان section_id موجودًا، يتم استخدامه فقط
                    $query->where('section_id', $request->section_id);
                }, function ($query) use ($request) {
                    // إذا لم يكن section_id موجودًا، يتم استخدام subject_id
                    if ($request->has('subject_id')) {
                        $query->where('subject_id', $request->subject_id);
                    }
                })
                ->get();

            return $this->okResponse($exams, 'the exams retrived successfully');
        }
    }
}
