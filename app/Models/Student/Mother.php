<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{

    protected $fillable = [
        'name',
        'last_name',
        'study_level',
        'work'
    ];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

