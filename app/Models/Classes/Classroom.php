<?php

namespace App\Models\Classes;

use App\Models\AcademicYear\StudyYear;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignmentSupervisor;
use App\Models\AssignmentTeacher;
use App\Models\studentClassroom;
use App\Models\Students\Student;

class Classroom extends Model
{
    protected $fillable = ['name', 'class_id', 'year_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function studyClass()
    {
        return $this->belongsTo(studyClass::class, 'class_id');
    }

    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class, 'year_id');
    }

    public function  assignmentTeachers()
    {
        return $this->hasMany(AssignmentTeacher::class);
    }

    public function assignmentSupervisors()
    {
        return $this->hasMany(AssignmentSupervisor::class);
    }

    public function studentClassrooms()
    {
        return $this->hasMany(studentClassroom::class);
    }

}
