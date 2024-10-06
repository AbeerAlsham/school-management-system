<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Accounts\Role;
use App\Models\Accounts\User;
use App\Models\Classes\Classroom;
use App\Models\SemesterUser;
use Illuminate\Http\Request;
use App\Models\Subjects\Subject;

class GetTeacherSubjectsSemesterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester, User $user, Classroom $classroom)
    {
        $user = User::find(auth()->user->id);

        $role = Role::where('name', 'teacher')->first();

        $userRole = $user->userRole()->where('role_id', $role->id)->first();

        $semesterUser = SemesterUser::where('user_role_id', $userRole->id)->where('semester_id', $semester->id)->first();

        $SubjectAndSection = Subject::whereHas('assignmentTeachers', function ($query) use ($semesterUser, $classroom) {
            $query->where('semester_user_id', $semesterUser->id)->Where('classroom_id', $classroom->id);
        })->with(['sections' => function ($query) use ($semesterUser, $classroom) {
            $query->whereHas('assignmentTeachers', function ($query) use ($semesterUser, $classroom) {
                $query->where('semester_user_id', $semesterUser->id)->Where('classroom_id', $classroom->id);
            });
        }])->get();

        return $this->okResponse($SubjectAndSection, 'subjects and sections  for teacher retrieved successfully');
    }
}
