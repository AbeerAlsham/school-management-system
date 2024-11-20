<?php

namespace App\Http\Controllers\Api\ExamPrograms;

use App\Http\Controllers\Controller;
use App\Models\Document\ExamProgram;
use Illuminate\Http\Request;

class DeleteExamProgramController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,ExamProgram $examProgram)
    {
        $examProgram->delete();
        return $this->noContentResponse();
    }
}
