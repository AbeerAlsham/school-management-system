<?php

namespace App\Models;

use App\Models\Classes\Classroom;
use Illuminate\Database\Eloquent\Model;

class studentClassroom extends Model
{
    protected $fillable = ['student_class_id', 'classroom_id', 'serial_number'];

    public function studentClasses()
    {
        return $this->belongsTo(studentClass::class);
    }
    public function classrooms()
    {
        return $this->belongsTo(Classroom::class);
    }
}
