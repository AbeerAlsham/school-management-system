<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Marks\addMarkRequest;
use App\Models\Accounts\Role;
use App\Models\Accounts\User;
use App\Models\AssignmentTeacher;
use App\Models\Mark;
use App\Models\SemesterUser;

class addMarkController extends Controller
{
    /**
     * اضافة علاماة لعدة طلاب
     */
    public function __invoke(addMarkRequest $request)
    {

        foreach ($request->marks as $mark) {
            if (!$this->isValidAccess($mark)) {
                return $this->forbiddenResponse('Access denied');
            }
        }

        foreach ($request->marks as $mark) {
            Mark::create($mark);
        }

        return $this->createdResponse('The marks assigned to students successfully');
    }

    //التحقق من كون المستخدم هو معلم و مسجل ضمن الفصل الدراسي لمادة معينة
    public function isValidAccess($data)
    {
        $user = User::find(auth()->user()->id);

        $role = Role::where('name', 'teacher')->first();

        $userRole = $user->userRole()->where('role_id', $role->id)->first();
        if (!$userRole) {
            return false;
        }

        $userSemester = SemesterUser::where('user_role_id', $userRole->id)->where('semester_id', $data['semester_id'])->first();

        if (!$userSemester) {
            return false;
        }

        $isValidTeacher = AssignmentTeacher::where('subject_id', $data['subject_id'])
            ->where('semester_user_id', $userSemester->id)
            ->exists();

        return $isValidTeacher || $user->roles->contains('name', 'manager');
    }
}
