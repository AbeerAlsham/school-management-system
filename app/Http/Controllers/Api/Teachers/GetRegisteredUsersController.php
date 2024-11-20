<?php

namespace App\Http\Controllers\Api\Teachers;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\AssignmentUser\SemesterUser;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class GetRegisteredUsersController extends Controller
{
    use Searchable;
    /**
     *  مع امكانية الفلترة بجسب الدور عرض المستخدمين المسجلين ضمن فصل دراسي معين
     * , البحث عم مستخدم معين مسجل
     */
    public function __invoke(Request $request, Semester $semester)
    {
        $query = SemesterUser::where('semester_id', $semester->id)
            ->with('userRole.user.profile:first_name,father_name,last_name,user_id');
        //filter by role
        if ($request->role_id)
            $query->whereHas('userRole', function ($q) use ($request) {
                $q->where('role_id', $request->role_id);
            });
        //search by fullname
        if ($request->search)
            $query->whereHas('userRole.user.profile', function ($q) use ($request) {
                return $this->Search($q, $request, ['first_name', 'father_name', 'last_name']);
            });

        return $this->okResponse($query->get(), 'teacher  registered in semester retrived successfully');
    }
}
