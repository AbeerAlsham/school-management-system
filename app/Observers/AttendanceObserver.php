<?php

namespace App\Observers;

use App\Models\Attendance;
use App\Models\UserRole;
use App\Services\NotificationService;
use App\Jobs\SendNotificationAttendanceJob;

class AttendanceObserver
{
    protected $notificationService;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }

    // إرسال الإشعارات عند تسجيل الحضور والغياب
    public function created(Attendance $attendance): void
    {
        $student = $attendance->student;
        $guardianUserIds = UserRole::getStudentGuardian($student);

        if ($attendance->status === 'غائب') {
            foreach ($guardianUserIds as $guardianId) {
                SendNotificationAttendanceJob::dispatch($guardianId, null, $attendance, 'absence');
            }
        }

        if ($attendance->calculateDaysCountAbsent($student)) {
            $adminIds = UserRole::getTeacher($attendance->semester_id, 'مدير');
            $student->studentClass->status == 'متسرب';

            foreach ($guardianUserIds as $guardianId) {
                SendNotificationAttendanceJob::dispatch($guardianId, 'أستاذي الكريم  نود إعلامكم أن الطالب ', $attendance, 'dropout');
            }

            foreach ($adminIds as $adminId) {
                SendNotificationAttendanceJob::dispatch($adminId, 'السيد/ة ولي أمر الطالب نود إعلامكم أن ابنكم ', $attendance, 'dropout');
            }
        }
    }
}
