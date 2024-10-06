<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class ShowNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Notification $notification)
    {
        return $this->okResponse($notification, 'the notification retrieved successfully');
    }
}
