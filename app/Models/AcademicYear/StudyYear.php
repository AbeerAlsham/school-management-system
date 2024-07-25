<?php

namespace App\Models\AcademicYear;

use App\Models\Classes\Classroom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class StudyYear extends Model
{
    use HasFactory;

    protected $fillable=['id','name','start_date','end_date'];

    public function semesters(){
        return $this->hasMany(Semester::class,'year_id');
    }

    public function classroom(){
        return $this->hasMany(Classroom::class,'year_id');
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
