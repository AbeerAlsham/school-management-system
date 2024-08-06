<?php

namespace App\Models\Classes;

use Illuminate\Database\Eloquent\Model;
use App\Models\AssignmentSupervisor;
use App\Models\AssignmentTeacher;
use App\Models\studentClass;
use App\Models\Subjects\subject;

class StudyClass extends Model
{
    protected $fillable = ['id', 'name', 'year_id', 'class_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject', 'class_id', 'subject_id')
            ->with('sections') // تضمين أقسام المادة
            ->distinct();    // إزالة تكرارات المواد
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'class_id');
    }

    public function assignmentSupervisors()
    {
        return $this->hasMany(AssignmentSupervisor::class);
    }

    public function assignmentTeachers()
    {
        return $this->hasMany(AssignmentTeacher::class, 'class_id');
    }
    public function studentClasses()
    {
        return $this->hasMany(studentClass::class);
    }
}
