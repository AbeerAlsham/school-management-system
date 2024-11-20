<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\UpdateExamRequest;
use App\Models\Exam\Exam;

class UpdateExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateExamRequest $request, Exam $exam)
    {

        // Adjust marks if total mark has changed
        if ($request->total_mark != $exam->total_mark) {
            $exam->updateMarks($request->total_mark);
        }
        $exam->update($request->all());


        return $this->okResponse($exam, 'the exam updated successfully');
    }
}
