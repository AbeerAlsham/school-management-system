<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\CreateExamRequest;
use App\Models\AcademicYear\Semester;
use App\Models\Exam;
use App\Models\ExamType;

class CreateExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateExamRequest $request)
    {
        if (!$this->isNOtValid($request['semester_id'], $request['exam_type_id']))
            return $this->forbiddenResponse("لا يمكنك إضافة اختبار جديد بسبب انتهاء الفصل الدراسي");
        $exam = Exam::create($request->all());

        return $this->createdResponse($exam, 'the exam created successfully');
    }

    public function isNotValid($semester_id, $exam_type_id)
    {
        $semester = Semester::find($semester_id);
        $examType = ExamType::find($exam_type_id);
        if (!$semester->is_current && !$semester->is_opened)
            return true;
        else if (!$semester->is_current && $semester->is_opened){
            if ($examType->name === 'امتحان الفصل')
                return false;
            else return true;}
        else
            return true;
    }
}
