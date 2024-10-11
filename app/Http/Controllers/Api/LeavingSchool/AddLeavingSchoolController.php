<?php

namespace App\Http\Controllers\Api\LeavingSchool;

use App\Http\Controllers\Controller;
use App\Models\Students\Student;
use Illuminate\Http\Request;

class AddLeavingSchoolController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Student $student)
    {

        $studyClassId =  $this->getClass($student);

        $leavingStudent = $student->leaveStudent()->create(array_merge($request->all(), ['study_class_id' => $studyClassId]));

        return $this->createdResponse($leavingStudent, 'the information of leaving added successfully');
    }

    public function getClass($student)
    {
        $lastStudentClass = $student->studentClasses()->latest('created_at')->first();
        return $lastStudentClass->studyClass->id;
    }
}
