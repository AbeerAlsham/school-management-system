<?php

namespace App\Models\Classes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subjects\subject;
class StudyClass extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','year_id','class_id'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject','class_id','subject_id');
    }

    public function classrooms(){
        return $this->hasMany(Classroom::class,'class_id');
    }
}
