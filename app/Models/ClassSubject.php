<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classes\StudyClass;
use App\Models\Subjects\{Section, Subject};

class ClassSubject extends Model
{
    protected $table = "class_subject";
    protected $fillable = ['class_id', 'subject_id', 'section_id'];

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function assignmentTeachers()
    {
        return $this->hasMany(AssignmentTeacher::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'class_subject_id');
    }
}
