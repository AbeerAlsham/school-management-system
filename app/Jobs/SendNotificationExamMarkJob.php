<?php

namespace App\Jobs;

use App\Models\Account\UserRole;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class SendNotificationExamMarkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationService;
    protected $exam;

    public function __construct($exam)
    {
        $this->notificationService = new NotificationService();
        $this->exam = $exam;
    }

    public function handle()
    {
        $adminIds = UserRole::getTeacher($this->exam->semester_id, 'مدير');
        foreach ($adminIds as $adminId) {
            $this->notificationService->implementNotification([
                'user_role_id' => $adminId,
                'semester_id' => $this->exam->semester_id,
                'title' => 'إجراء اختبار',
                'content' => 'السيد/ة المدير، نود إعلامكم أن المعلم ' .
                    $this->exam->teacher->profile->first_name .
                    ' قد أضاف بعض العلامات لطلاب الشعبة ' . $this->exam->classroom->name .
                    'في مادة ' . $this->exam->subject->name . 'يرجى مراجعته و الموافقة عليه',
                'type_content' => 'exam_marks',
                'type_content_id' => $this->exam->id
            ]);
        }
    }
}
