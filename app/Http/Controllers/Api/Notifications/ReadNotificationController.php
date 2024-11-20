<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Notification\Notification;
use Illuminate\Http\Request;

class ReadNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Notification $notification)
    {
         $notification->update(['is_read'=> 1]);
        return $this->okResponse($notification, 'the notification updated successfully');
    }
}
