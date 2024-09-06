<?php

namespace App\Observers;

use App\Models\Accounts\User;
use App\Models\Attendance;
use App\Notifications\absentStudentNotification;
use App\Notifications\StudentDroppingOutNotification;

class AttendanceObserver
{
    /**
     * Handle the Attendance "created" event.
     */
    public function created(Attendance $attendance): void
    {
        if ($attendance->status === 'غائب')
            $attendance->student()->Guardian()->notify(new absentStudentNotification($attendance->student));

        if ($attendance->calculateDaysCountAbsent($attendance->student))
            $admin = User::whereHas('roles', function ($q) {
                $q->where('name', 'manager');
            })->first();

        $admin->notify(new StudentDroppingOutNotification($attendance->student));
    }

    /**
     * Handle the Attendance "updated" event.
     */
    public function updated(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "deleted" event.
     */
    public function deleted(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "restored" event.
     */
    public function restored(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "force deleted" event.
     */
    public function forceDeleted(Attendance $attendance): void
    {
        //
    }
}
