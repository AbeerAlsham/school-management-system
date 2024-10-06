<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Marks\addMarkRequest;
use App\Jobs\SendNotificationExamMarkJob;
use App\Jobs\SendNotificationMarkTOGuardiansJob;
use App\Models\Accounts\Role;
use App\Models\Accounts\User;
use App\Models\AssignmentTeacher;
use App\Models\Exam;
use App\Models\SemesterUser;
use App\Services\NotificationService;

class addMarkController extends Controller
{
    /**
     * اضافة علاماة لعدة طلاب
     */
    public function __invoke(addMarkRequest $request, Exam $exam)
    {
        foreach ($request->marks as $mark) {
            if (!$this->isValidAccess($mark, $exam)) {
                return $this->forbiddenResponse('Access denied');
            }
        }
        $marks = [];
        foreach ($request->marks as $mark) {
            if (in_array($exam->examType->name, ['شفهي', 'وظائف + أوراق عمل', 'نشاطات و مبادرات'])) {
                $mark['is_accepted'] = 1;
            }
            $marks[] = $exam->marks()->create($mark);
        }

        SendNotificationExamMarkJob::dispatch($exam);
        SendNotificationMarkTOGuardiansJob::dispatch($marks);
        return $this->createdResponse($marks, 'The marks assigned to students successfully');
    }

    //التحقق من كون المستخدم هو معلم و مسجل ضمن الفصل الدراسي لمادة معينة
    public function isValidAccess($data, $exam)
    {
        $user = User::find(request()->user()->id);

        $role = Role::where('name', 'معلّم')->first();

        $userRole = $user->userRole()->where('role_id', $role->id)->first();
        if (!$userRole) {
            return false;
        }

        $userSemester = SemesterUser::where('user_role_id', $userRole->id)->where('semester_id', $exam->semester_id)->first();

        if (!$userSemester) {
            return false;
        }

        $isValidTeacher = AssignmentTeacher::where('subject_id', $data['subject_id'])
            ->where('semester_user_id', $userSemester->id)
            ->exists();

        return $isValidTeacher || $user->roles->contains('name', 'مدير');
    }
}
