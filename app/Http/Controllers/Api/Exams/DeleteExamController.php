<?php

namespace App\Http\Controllers\Api\Exams;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class DeleteExamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Exam $exam)
    {
        $exam->delete();
        return $this->noContentResponse();
    }
}
