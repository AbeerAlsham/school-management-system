<?php

namespace App\Models;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastSchoolInfo extends Model
{
    use HasFactory;

    protected $fillable = ['school_name', 'school_address', 'previous_result', 'failed_grades', 'student_id'];


    public function student(){
        return $this->belongsTo(Student::class);
    }
}
