<?php

namespace App\Models\Student;

use App\Models\AcademicYear\StudyYear;
use App\Models\AssignmentStudent\studentClass;
use App\Models\Class\StudyClass;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class enrollment extends Model
{

    protected $fillable = ['student_id', 'document_date', 'document_number', 'enrollment_date', 'class_id'];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function gradeEnrollment()
    {
        return $this->belongsTo(StudyClass::class, 'class_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($enrollment) {

            // تحويل التاريخ إلى كائن Carbon
            $carbonDate = Carbon::parse($enrollment->enrollment_date);

            // جلب العام الدراسي بناءً على التاريخ
            $studyYear = StudyYear::where('start_date', '<=', $carbonDate)
                ->where('end_date', '>=', $carbonDate)
                ->firstOrFail();

            //تسجيل الطالب ضمن الصف الدراسي المناسب
            studentClass::create([
                'student_id' => $enrollment->student_id,
                'study_year_id' => $studyYear->id,
                'study_class_id' => $enrollment->class_id,
                'status' => 'مسجل'
            ]);
        });
    }
}
