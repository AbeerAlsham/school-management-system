<?php

namespace App\Http\Controllers\Api\Teachers;

use App\Http\Controllers\Controller;
use App\Models\AssignmentTeacher;
use App\Http\Requests\Teachers\AssignmentTeacherRequest;

class AssignmentTeacherController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignmentTeacherRequest $request)
    {
        $assign_teacher = AssignmentTeacher::create($request->all());
        return $this->okResponse($assign_teacher,'the teacher assigned to classes and subject');
    }
}
