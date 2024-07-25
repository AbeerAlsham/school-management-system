<?php

namespace App\Http\Controllers\Api\Teachers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\SemesterUser;
use App\Models\Subjects\Subject;

class GetSubjectTeachersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester, Subject $subject)
    {
        $teachers = SemesterUser::where('semester_id', $semester->id)
            ->whereHas('userRoles', function ($query) use ($subject) {
                return $query->whereHas('user.subjects', function ($query) use ($subject) {
                    return $query->where('subjects.id', $subject->id);
                });
            })
            ->with('userRoles.user.profile:first_name,father_name,last_name,user_id')
            ->get();

        // $teachers = $subject->teachers()
        //  ->with('profile:first_name,father_name,last_name,user_id') // تضمين معلومات الملف الشخصي للمعلمين
        // ->whereHas('userRole', function ($query) use ($semester) {
        //     // التحقق من ارتباط المعلم بالفصل الدراسي
        //     return $query->whereHas('semesters', function ($query) use ($semester) {
        //         return $query->where('semesters.id', $semester->id); // تحديد "semesters.id"
        //     });
        // })
        // ->get();

        return $this->okResponse($teachers, 'the teachers retrived successfully');
    }
}
