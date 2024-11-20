
<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(
    function () {
        Route::group(
            ['namespace' => 'Notifications'],
            function () {
                Route::get('/semesters/{semester}/users-roles/{userRole}/notifications', 'GetNotificationController');
                Route::get('/notifications/{notification}', 'ShowNotificationController');
                Route::put('notifications/{notification}/read-notification', 'ReadNotificationController');
                Route::get('semesters/{semester}/users-roles/{userRole}/notifications/unread-count', 'UnReadCountsNotificationController');
            }
        );
    }
);
