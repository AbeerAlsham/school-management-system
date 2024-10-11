<?php

namespace App\Models;

use App\Models\Classes\StudyClass;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class LeavingSchool extends Model
{
    protected $fillable = ['student_id', 'study_class_id', 'leave_date', 'cause', 'document_type', 'document_number', 'document_date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class);
    }
}
