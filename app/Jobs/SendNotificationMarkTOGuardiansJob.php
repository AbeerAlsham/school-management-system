<?php

namespace App\Jobs;

use App\Models\Account\UserRole;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationMarkTOGuardiansJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationService;
    protected $marks;

    public function __construct($marks)
    {
        $this->notificationService = new NotificationService();
        $this->marks = $marks;
    }

    public function handle()
    {
        foreach ($this->marks as $mark) {
            $guardianIds = UserRole::getStudentGuardian($mark->studentClass->student);

            if ($mark->is_accepted) {
                foreach ($guardianIds as $guardianId) {
                    $this->notificationService->implementNotification([
                        'user_role_id' => $guardianId,
                        'semester_id' => $mark->exam->semester_id,
                        'title' => 'إجراء اختبار',
                        'content' => 'السيد/ة ولي أمر الطالب، نود إعلامكم أن ابنكم ' .
                            $mark->studentClass->student->first_name .
                            ' قد حصل على ' . $mark->earned_mark .
                            ' من ' . $mark->exam->total_mark . ' في ' . $mark->exam->test_name,
                        'type_content' => 'mark',
                        'type_content_id' => $mark->id
                    ]);
                }
            }
        }
    }
}
