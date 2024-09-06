<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\CreateExamRequest;
use App\Models\Exam;
use Illuminate\Http\Request;

class CreateExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateExamRequest $request)
    {
        $request['teacher_id']=$request->user()->id;
        $exam = Exam::create($request->all());

        return $this->createdResponse($exam, 'the exam created successfully');
    }
}
