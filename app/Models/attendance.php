<?php

namespace App\Models;

use App\Models\AcademicYear\Semester;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $fillable = ['semester_id', 'student_id', 'date', 'status', 'is_justified', 'note'];

    protected $hidden = ['created_at', 'updated_at'];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
