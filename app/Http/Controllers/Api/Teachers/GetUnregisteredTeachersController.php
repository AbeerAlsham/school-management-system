<?php

namespace App\Http\Controllers\Api\Teachers;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use App\Models\AcademicYear\Semester;
use App\Models\Accounts\Role;
use App\Models\SemesterUser;
use Illuminate\Http\Request;

class GetUnregisteredTeachersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Semester $semester)
    {
        $teacher=Role::where('name','teacher')->first();

        $assignedTeacherIds = SemesterUser::where('semester_id', $semester->id)
        ->pluck('user_role_id');

        $unassignedTeachers = UserRole::where('role_id', $teacher->id)
        ->whereNotIn('id', $assignedTeacherIds)
         ->with('user.profile:')  // تحميل العلاقة 'user'
    ->get();

    }
}
