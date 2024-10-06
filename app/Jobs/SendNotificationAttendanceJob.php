<?php

namespace App\Jobs;

use App\Services\NotificationService;
use App\Models\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationAttendanceJob  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationService;
    protected $attendance;
    protected $userId;
    protected $message;
    protected $type;

    public function __construct($userId, $message, Attendance $attendance, $type)
    {
        $this->notificationService = new NotificationService();
        $this->attendance = $attendance;
        $this->userId = $userId;
        $this->message = $message;
        $this->type = $type;
    }

    public function handle()
    {
        if ($this->type === 'absence') {
            $this->notificationService->implementNotification([
                'user_role_id' => $this->userId,
                'semester_id' => $this->attendance->semester_id,
                'title' => 'تسجيل حالة غياب',
                'content' => 'السيد/ة ولي أمر الطالب نود إعلامكم عن تغيب ولدكم ' .
                    $this->attendance->student->first_name .
                    ' عن الدوام في المدرسة.',
                'type_content' => 'attendance',
            ]);
        } elseif ($this->type === 'dropout') {
            $this->notificationService->implementNotification([
                'user_role_id' => $this->userId,
                'semester_id' => $this->attendance->semester_id,
                'title' => 'تسجيل حالة تسرب ',
                'content' => $this->message .
                    $this->attendance->student->first_name .
                    ' قد أصبح متسرباً من المدرسة بسبب غيابه لمدة 14 يوماً متتالياً.',
                'type_content' => 'attendance',
            ]);
        }
    }
}
