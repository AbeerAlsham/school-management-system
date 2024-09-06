<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\UpdateExamRequest;
use App\Models\Exam;
use Illuminate\Http\Request;

class UpdateExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateExamRequest $request,Exam $exam)
    {
        $exam->update($request->all());
return $exam;
        return $this->okResponse( $exam,'the exam updated successfully');
    }
}
