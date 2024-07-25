<?php

namespace App\Http\Controllers\APi\Subjects;

use App\Models\Accounts\User;
use App\Http\Requests\Subjects\AssignTeacherSubjectRequest;
use App\Http\Controllers\Controller;

class AssignmentTeacherSubjectsController extends Controller
{
    public function __invoke(AssignTeacherSubjectRequest $request, User $user)
    {

        if ($this->checkTeacher($user)) {
            $user->subjects()->attach($request->subject_ids);
            return $this->successResponse($user->subjects, 'the subject assignment successfully');
        } else {
            return $this->unprocessableResponse('the user have not teacher role');
        }
    }

    public function checkTeacher(User $user): bool
    {
        if ($user->roles->contains('name', 'teacher'))
            return true;
        return false;
    }
}
