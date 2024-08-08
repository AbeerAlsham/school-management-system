<?php

namespace App\Models\Subjects;

use App\Models\Accounts\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Classes\StudyClass;
use App\Models\AssignmentTeacher;
use App\Models\Mark;

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
        return $this->hasMany(Mark::class);
    }

    protected $hidden = ['pivot', 'updated_at', 'created_at'];
}
