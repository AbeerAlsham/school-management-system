<?php

namespace App\Jobs;

use App\Models\AcademicYear\Semester;
use App\Models\Account\UserRole;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// عند إضافة برنامج الأسبوع ارسال اشعار لطلاب شعبة معينة
class SendNotificationWeekProgramJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationService;
    protected $weekProgram;

    public function __construct($weekProgram)
    {
        $this->notificationService = new NotificationService();
        $this->weekProgram = $weekProgram;
    }

    public function handle()
    {
        foreach ($this->weekProgram->classroom->studentClassrooms as $studentClassroom) {
            //جلب معلومات كل طالب من طلاب الشعبة
            $student = $studentClassroom->studentClass->student;
            //الحصول على معرفات اولياء الامور
            $guardianIds = UserRole::getStudentGuardian($student);
            //ارسال الاشعار لكل ولي امر من أولياء أمور الطالب
            foreach ($guardianIds as $guardianId) {
                $this->notificationService->implementNotification([
                    'user_role_id' => $guardianId,
                    'semester_id' => Semester::currentSemester()->id,
                    'title' => 'إضافة وثيقة',
                    'content' => 'السيد/ة ولي أمر الطالب، نود إعلامكم أنه تم إضافة برنامج الأسبوع لولدكم ' .
                        $student->first_name .
                        ' يرجى الاطلاع عليه ',

                    'type_content' => 'week_program',
                    'type_content_id' => $this->weekProgram->id
                ]);
            }
        }
    }
}
