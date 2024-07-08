<?php

namespace App\Models\Subjects;

use App\Models\Accounts\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Classes\StudyClass;
use App\Models\TeacherSubject;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function classes()
    {
        return $this->belongsToMany(StudyClass::class, 'class_subject', 'subject_id', 'class_id')->withPivot('section_id');
    }

    // public function sections()
    // {
    //     return $this->belongsToMany(Section::class, 'class_subject')->withPivot('class_id');
    // }
    public function sections()
    {
        return $this->hasMany(Section::class, 'subject_id');
    }
    
    public function teacher()
    {
        return $this->belongsToMany(User::class, 'teacher_subjects');
    }
}
