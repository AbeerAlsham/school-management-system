<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ShowSubjectExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->has('semester_id') && ($request->has('subject_id') || $request->has('section_id')) && $request->has('classroom_id')) {
            $exams = Exam::with('examType','semesterUser.userRole.user.profile:first_name,last_name')->where('semester_id', $request->semester_id)
                ->where('classroom_id', $request->classroom_id)
                ->where('subject_id', $request->subject_id)
                ->orWhere('section_id', $request->section_id)
                ->get();

                return $this->okResponse($exams,'the exams retrived successfully');
        }
    }
}
