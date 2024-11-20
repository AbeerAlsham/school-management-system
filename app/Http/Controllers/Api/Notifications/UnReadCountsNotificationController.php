<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Account\UserRole;
use App\Models\Notification\Notification;
use Illuminate\Http\Request;

class UnReadCountsNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester,UserRole $userRole)
    {
        $count = Notification::where('semester_id', $semester->id)
            // ->where('user_id', auth()->user->id)
            ->where('user_role_id',$userRole->id)
            ->where('is_read', 0)->count();
        return $this->okResponse($count, 'the count of unread notification retrived successfully');
    }
}
