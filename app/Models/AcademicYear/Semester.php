<?php

namespace App\Models\AcademicYear;

use App\Models\Accounts\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRole;
use App\Models\SemesterUser;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'startDate', 'endDate', 'year_id'];

    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class);
    }

    public function userRoles()
    {
        return $this->belongsToMany(UserRole::class, 'semester_users');
    }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'users_roles');
    // }

    // public function teacher()
    // {
    //     return $this->belongsToMany(User::class, 'assignment_teachers', 'semester_id','teacher_id')
    //         ->withPivot('section_id', 'subject_id', 'classroom_id');
    // }

}
