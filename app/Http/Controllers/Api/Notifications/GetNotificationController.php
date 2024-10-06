<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Notification;
use App\Models\UserRole;
use Illuminate\Http\Request;

class GetNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester,UserRole $userRole)
    {
        $notification = Notification::where('semester_id', $semester->id)
            // ->where('user_id', auth()->user->id)->get();
            ->where('user_role_id', $userRole->id)->get();
        return $this->successResponse($notification, 'the notifications retrived successfully');
    }
}
