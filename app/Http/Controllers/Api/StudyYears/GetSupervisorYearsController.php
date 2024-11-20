<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Models\Account\User;
use Illuminate\Http\Request;


class GetSupervisorYearsController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {

        //عرض الاعوام والفصول الدراسية التي يدرس بها المعلم
        // $userId = $user->id;
        // $academicYears = StudyYear::with([
        //     'semesters' => function ($query) use ($userId) {
        //         $query->whereHas('semesterUsers', function ($q) use ($userId) {
        //         $q->whereHas('userRoles', function ($qr) use ($userId) {
        //                 $qr->where('user_id', $userId);
        //             });
        //         })->distinct();
        //     }

        // ])->get();
        // return  $academicYears;

    }
}
