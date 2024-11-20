<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Models\Exam\Exam;
use Illuminate\Http\Request;

class ShowExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Exam $exam)
    {
        return $this->okResponse([$exam->load('examType')], 'the exam retrives successfully');
    }
}
