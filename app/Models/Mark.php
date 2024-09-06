<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mark extends Model
{
    protected $fillable = ['exam_id', 'student_class_id', 'earned_mark'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function studentClass()
    {
        return $this->belongsTo(studentClass::class);
    }
}
