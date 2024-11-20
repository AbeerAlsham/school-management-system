<?php

namespace App\Models\AcademicYear;

use App\Models\Account\UserRole;
use App\Models\AssignmentUser\SemesterUser;
use App\Models\Attendance\Attendance;
use App\Models\Document\ExamProgram;
use App\Models\Mark\mark;
use Illuminate\Database\Eloquent\Model;


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
        return $this->hasMany(mark::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function ExamPrograms()
    {
        return $this->hasMany(ExamProgram::class, 'semester_id');
    }

    public static function availableSemester()
    {
        return self::where('is_current', true)
            ->orWhere('is_opened', true)->pluck('id')->toArray();
    }

    ///event for add new semester to change is_current to fals for last semester
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($semester) {
            // تحديث حالة الفصل السابق إلى غير خالية
            $semester = self::latest()->first();
            if ($semester) {
                $semester->is_current = 0;
                $semester->save();
            }
        });
    }
}
