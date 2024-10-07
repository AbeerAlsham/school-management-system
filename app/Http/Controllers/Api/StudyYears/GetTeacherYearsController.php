<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Models\UserRole;
use Illuminate\Http\Request;

class GetTeacherYearsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //الحصول على الفصول الدراسية التي سجل بها الاستاذ ضمن العام ااحالي
    public function __invoke(Request $request, UserRole $userRole)
    {
        $studyYear = StudyYear::where('is_current', 1)->first();
        $semesters = $userRole->semesters()->where('semesters.year_id', $studyYear->id)->get();
        //     ->whereHas('semesters', function ($query) use ($userId) { // تأكد من أن المعلم لديه فصل دراسي في هذا العام
        //         $query->whereHas('semesterUsers', function ($q) use ($userId) {
        //             $q->whereHas('userRoles', function ($qr) use ($userId) {
        //                 $qr->where('user_id', $userId);
        //             });
        //         });
        //     })
        //     ->orderBy('start_date', 'asc')
        //     ->get();

        return  $this->okResponse($semesters, 'Academic Year retrived successfully');
    }
}
