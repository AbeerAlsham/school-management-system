<?php

namespace App\Http\Controllers\Api\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teachers\AssignmentTeacherRequest;
use App\Models\AssignmentUser\AssignmentTeacher;

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
