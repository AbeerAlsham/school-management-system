<?php

namespace App\Http\Controllers\Api\LeavingSchool;

use App\Http\Controllers\Controller;
use App\Models\Student\Student;
use Illuminate\Http\Request;

class ShowLeavingSchoolController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Student $student)
    {
        $leavingStudent = $student->LeaveStudent()->with('studyClass')->first();
        return $this->okResponse($leavingStudent, 'the information of leaving retrieved successfully');
    }
}
