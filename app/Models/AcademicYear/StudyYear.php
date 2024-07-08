<?php

namespace App\Models\AcademicYear;

use App\Models\Classes\Classroom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyYear extends Model
{
    use HasFactory;

    protected $fillable=['id','name','startDate','endDate'];

    public function semesters(){
        return $this->hasMany(Semester::class,'year_id');
    }

    public function classroom(){
        return $this->hasMany(Classroom::class,'year_id');
    }
    public function users()
    {
        return $this->hasManyThrough(
            'App\Models\Account\User',
            'App\Models\Semester',
            'year_id', // Foreign key on semesters table...
            'id',               // Local key on academic years table...
            'id',               // Local key on semesters table...
            'user_id'           // Foreign key on semester_user table...
        );
    }
}
