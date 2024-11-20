<?php

namespace App\Models\Class;

use App\Models\AcademicYear\StudyYear;
use App\Models\AssignmentStudent\studentClassroom;
use App\Models\AssignmentUser\AssignmentSupervisor;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignmentUser\AssignmentTeacher;
use App\Models\Document\ExamProgram;
use App\Models\Document\WeekProgram;
use App\Models\Exam\Exam;

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
        return $this->hasMany(studentClassroom::class, 'classroom_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'classroom_id');
    }

    public function ExamPrograms()
    {
        return $this->hasMany(ExamProgram::class, 'classroom_id');
    }

    public function WeekPrograms()
    {
        return $this->hasMany(WeekProgram::class, 'classroom_id');
    }
}
