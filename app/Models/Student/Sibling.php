<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'study_level', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
