<?php

namespace App\Models;

use App\Models\AcademicYear\StudyYear;
use App\Models\Classes\StudyClass;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class studentClass extends Model
{
    protected $fillable = ['student_id', 'study_class_id', 'study_year_id', 'status'];

    protected $hidden=['created_at','updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(StudyClass::class);
    }

    public function studyYears()
    {
        return $this->belongsTo(StudyYear::class);
    }

    public function studentClassroom()
    {
        return $this->hasOne(studentClassroom::class);
    }

    public function marks(){
        return $this->hasMany(Mark::class);
    }
}
