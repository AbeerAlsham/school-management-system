<?php

namespace App\Models;

use App\Models\Classes\StudyClass;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enrollment extends Model
{
    use HasFactory;

    protected $fillable=['student_id','document_date','document_number','enrollment_date','class_id'];


    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function gradeEnrollment(){
        return $this->belongsTo(StudyClass::class,'class_id');
    }
    
}
