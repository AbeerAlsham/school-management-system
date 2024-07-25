<?php

namespace App\Http\Controllers\Api\Teachers;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use App\Models\AcademicYear\Semester;
use App\Models\Accounts\Role;
use App\Models\SemesterUser;
use Illuminate\Http\Request;

class GetUnregisteredUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */

     //عرض الموجهين/المعلمين/الإداريين  غير المسحلين ضمن فصل دراسي معين
    public function __invoke(Request $request, Semester $semester)
    {
        $teacher = Role::where('name', $request->role)->first();

        $assignedTeacherIds = SemesterUser::where('semester_id', $semester->id)
            ->pluck('user_role_id');

        $unassignedTeachers = UserRole::where('role_id', $teacher->id)
            ->whereNotIn('id', $assignedTeacherIds)
            ->with('user.profile:first_name,father_name,last_name,user_id')  // تحميل العلاقة 'user'
            ->get();

        return $this->okResponse( $unassignedTeachers,'teacher not registered in semester retrived successfully');
    }
}
