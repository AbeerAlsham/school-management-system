<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mark extends Model
{
    protected $fillable = ['exam_id', 'student_class_id', 'earned_mark','is_accepted'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function studentClass()
    {
        return $this->belongsTo(studentClass::class);
    }

    public function sendNotification($marks)
    {
        foreach ($marks as $mark) {
            $guardianIds = UserRole::getStudentGuardian($mark->studentClass->student);
            foreach ($guardianIds as $guardianId) { // Loop through all guardian IDs
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
