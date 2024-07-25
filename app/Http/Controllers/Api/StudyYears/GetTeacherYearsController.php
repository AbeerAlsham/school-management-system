<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Models\Accounts\User;
use Illuminate\Http\Request;

class GetTeacherYearsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $userId=$user->id;
        // التحقق من id المستخدم المُصادق عليه
        // if ($user->id !== auth()->id()) {
        //     return response()->json(['error' => 'الوصول غير مُرخّص.'], 403);
        // }
        $academicYears = StudyYear::with([
                'semesters' => function ($query) use ($userId) {
                    $query->whereHas('semesterUsers', function ($q) use ($userId) {
                        $q->whereHas('userRoles', function ($qr) use ($userId) {
                            $qr->where('user_id', $userId);
                        });
                    })->orderBy('start_date', 'asc')
                    ->distinct();
                }
            ])
            ->whereHas('semesters', function ($query) use ($userId) { // تأكد من أن المعلم لديه فصل دراسي في هذا العام
                $query->whereHas('semesterUsers', function ($q) use ($userId) {
                    $q->whereHas('userRoles', function ($qr) use ($userId) {
                        $qr->where('user_id', $userId);
                    });
                });
            })
            ->orderBy('start_date', 'asc')
            ->get();

        return  $this->okResponse($academicYears, 'Academic Year retrived successfully');
    }
}
