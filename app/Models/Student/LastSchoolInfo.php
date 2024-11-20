<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class LastSchoolInfo extends Model
{
    protected $fillable = ['school_name', 'school_address', 'previous_result', 'failed_grades', 'student_id'];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
