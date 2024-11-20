<?php

namespace App\Models\AcademicYear;

use App\Models\Book\YearBook;
use App\Models\Class\Classroom;
use App\Models\Student\Student;

use Illuminate\Database\Eloquent\Model;

class StudyYear extends Model
{
    protected $fillable = ['id', 'name', 'start_date', 'end_date', 'is_current', 'is_opened'];

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

    public function yearBooks()
    {
        return $this->hasMany(YearBook::class, 'study_year_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_classes');
    }

    public static function currentYear()
    {
        return self::where('is_current', true)->first();
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($studyYear) {
            // تحديث حالة الفصل السابق إلى غير خالية
            $previousYear = self::latest()->first();
            if ($previousYear) {
                $previousYear->is_current = 0;
                $previousYear->save();
            }
        });
    }
}
