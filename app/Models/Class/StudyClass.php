<?php

namespace App\Models\Class;

use App\Models\AssignmentStudent\studentClass;
use App\Models\AssignmentUser\AssignmentSupervisor;
use App\Models\AssignmentUser\AssignmentTeacher;
use App\Models\LeavingSchool;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student\Student;
use App\Models\Subject\subject;

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
        return $this->hasMany(AssignmentSupervisor::class,'class_id');
    }

    public function assignmentTeachers()
    {
        return $this->hasMany(AssignmentTeacher::class, 'class_id');
    }

    public function StudentClasses()
    {
        return $this->hasMany(studentClass::class);
    }
    public function LeaveStudent()
    {
        return $this->hasMany(LeavingSchool::class, 'study_class_id');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_classes')->withPivot('study_year_id', 'status');
    }
}
