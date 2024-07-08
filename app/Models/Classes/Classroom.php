<?php

namespace App\Models\Classes;

use App\Models\AcademicYear\StudyYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\User;

class Classroom extends Model
{
    protected $fillable=['name','class_id','year_id'];

    public function studyClass()
    {
        return $this->belongsTo(studyClass::class,'class_id');
    }

    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class,'year_id');
    }

    // public function teachers()
    // {
    //     return $this->belongsToMany(User::class, 'assignment_teachers', 'classroom_id', 'teacher_id')
    //         ->withPivot('class_id', 'section_id', 'subject_id');
    // }
}
