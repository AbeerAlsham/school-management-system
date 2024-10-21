<?php

namespace App\Jobs;

use App\Models\AcademicYear\Semester;
use App\Models\UserRole;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// عند إضافة برنامج الامتحان ارسال اشعار لطلاب شعبة معينة
class SendNotificationExamProgramJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationService;
    protected $examProgram;

    public function __construct($examProgram)
    {
        $this->notificationService = new NotificationService();
        $this->examProgram = $examProgram;
    }

    public function handle()
    {
        foreach ($this->examProgram->classroom->studentClassrooms as $studentClassroom) {
            $student = $studentClassroom->studentClass->student;
            $guardianIds = UserRole::getStudentGuardian($student);
            foreach ($guardianIds as $guardianId) {
                $this->notificationService->implementNotification([
                    'user_role_id' => $guardianId,
                    'semester_id' => Semester::currentSemester()->id,
                    'title' => 'إضافة وثيقة',
                    'content' => 'السيد/ة ولي أمر الطالب، نود إعلامكم أنه تم إضافة برنامج الامتحان لولدكم ' .
                        $student->first_name .
                        ' يرجى الاطلاع عليه ',

                    'type_content' => 'exam_program',
                    'type_content_id' => $this->examProgram->id
                ]);
            }
        }
    }
}
