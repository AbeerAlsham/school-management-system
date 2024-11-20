<?php

namespace App\Models\AssignmentStudent;

use App\Enums\StudentStatus;
use App\Models\AcademicYear\StudyYear;
use App\Models\Book\BookDelivery;
use App\Models\Class\StudyClass;
use App\Models\Mark\mark;
use App\Models\Note\Note;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Model;

class studentClass extends Model
{
    protected $fillable = ['student_id', 'study_class_id', 'study_year_id', 'status'];

    protected $hidden = ['created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class);
    }

    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class);
    }

    public function studentClassroom()
    {
        return $this->hasOne(studentClassroom::class);
    }

    public function marks()
    {
        return $this->hasMany(mark::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'student_class_id');
    }

    public function bookDeliveries()
    {
        return $this->hasMany(BookDelivery::class, 'student_class_id');
    }

    // protected $casts = [
    //     'status' => StudentStatus::class,
    // ];
}
