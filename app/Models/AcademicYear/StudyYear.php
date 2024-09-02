<?php

namespace App\Models\AcademicYear;

use App\Models\Classes\Classroom;
use App\Models\Holiday;
use App\Models\studentClass;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class StudyYear extends Model
{
    protected $fillable = ['id', 'name', 'start_date', 'end_date'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function semesters()
    {
        return $this->hasMany(Semester::class, 'year_id');
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class, 'year_id');
    }
    
    public function classroom()
    {
        return $this->hasMany(Classroom::class, 'year_id');
    }

    // public function studentClasses()
    // {
    //     return $this->hasMany(studentClass::class);
    // }

    public function students()
    {
        return $this->belongsToMany(Student::class,'student_classes');
    }
}
