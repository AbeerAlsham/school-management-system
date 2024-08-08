<?php

namespace App\Models\AcademicYear;

use App\Models\Accounts\User;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRole;
use App\Models\SemesterUser;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'start_date', 'end_date', 'year_id'];

    protected $hidden = [ 'created_at', 'updated_at'];

    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class,'year_id');
    }

    public function userRoles()
    {
        return $this->belongsToMany(UserRole::class, 'semester_users');
    }

    public function semesterUsers(){
        return $this->hasMany(SemesterUser::class);
    }
    
    public function marks(){
        return $this->hasMany(Mark::class);
    }


}
