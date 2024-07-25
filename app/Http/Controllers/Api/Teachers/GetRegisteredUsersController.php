<?php

namespace App\Http\Controllers\Api\Teachers;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use App\Models\AcademicYear\Semester;
use App\Models\Accounts\Role;
use App\Models\SemesterUser;
use Illuminate\Http\Request;

class GetRegisteredUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester)
    {
        $role = Role::where('name', $request->role)->first();
        
        $assignedUserIds = SemesterUser::where('semester_id', $semester->id)
            ->pluck('user_role_id');

        $unassignedUsers = UserRole::where('role_id', $role->id)
            ->whereIn('id', $assignedUserIds)
            ->with('user.profile:first_name,father_name,last_name,user_id')
            ->get();

        return $this->okResponse( $unassignedUsers,'teacher  registered in semester retrived successfully');
    }
}
