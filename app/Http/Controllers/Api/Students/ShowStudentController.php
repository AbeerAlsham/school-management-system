<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Models\Student\Student ;
use Illuminate\Http\Request;

class ShowStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Student $student)
    {
        $student = $student->with(['mother', 'father', 'siblings'])->find($student->id);
        return $this->okResponse($student);
    }
}
