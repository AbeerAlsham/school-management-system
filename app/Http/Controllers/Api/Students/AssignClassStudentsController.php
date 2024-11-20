<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\AssignClassStudentsRequest;
use App\Models\AssignmentStudent\studentClass;

class AssignClassStudentsController extends Controller
{
    /**
     *تسجيل عدة طلاب ضمن صف دراسي معين .
     */
    public function __invoke(AssignClassStudentsRequest $request)
    {
        foreach ($request->student_ids as $studentId) {
            studentClass::create([
                'student_id' => $studentId,
                'study_class_id' => $request->study_class_id,
                'study_year_id' => $request->study_year_id,
                'status' => 'مسجل'
            ]);
        }
        return $this->okResponse('the students have added to class successfully');
    }
}
