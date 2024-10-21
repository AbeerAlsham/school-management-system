<?php

namespace App\Models\AcademicYear;

use App\Models\Attendance;
use App\Models\ExamProgram;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRole;
use App\Models\SemesterUser;
use DateTime;

class Semester extends Model
{
    protected $fillable = ['id', 'name', 'start_date', 'end_date', 'year_id', 'is_current', 'is_opened'];

    protected $hidden = ['created_at', 'updated_at'];

    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class, 'year_id');
    }

    public function userRoles()
    {
        return $this->belongsToMany(UserRole::class, 'semester_users');
    }

    public function semesterUsers()
    {
        return $this->hasMany(SemesterUser::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function ExamPrograms()
    {
        return $this->hasMany(ExamProgram::class, 'semester_id');
    }

    public static function currentSemester()
    {
        $currentDate = new DateTime();

        return self::where('start_date', '<=', $currentDate)
                    ->where('end_date', '>=', $currentDate)
                    ->first();
    }

}
