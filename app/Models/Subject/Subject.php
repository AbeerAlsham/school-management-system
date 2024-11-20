<?php

namespace App\Models\Subject;

use App\Models\Account\User;
use App\Models\AssignmentUser\AssignmentTeacher;
use Illuminate\Database\Eloquent\Model;
use App\models\Class\StudyClass;
use App\Models\Mark\mark;

class Subject extends Model
{
    protected $fillable = ['name','min_mark','max_mark'];

    public function classes()
    {
        return $this->belongsToMany(StudyClass::class, 'class_subject', 'subject_id', 'class_id')->withPivot('section_id')->distinct();;
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'subject_id');
    }

    public function sectionClass()
    {
        return $this->belongsToMany(Section::class, 'class_subject');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_subjects');
    }

    public function assignmentTeachers()
    {
        return $this->hasMany(AssignmentTeacher::class);
    }

    public function marks(){
        return $this->hasMany(mark::class);
    }

    protected $hidden = ['pivot', 'updated_at', 'created_at'];
}
