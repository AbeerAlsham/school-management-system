<?php

namespace App\Models;

use App\Models\AcademicYear\Semester;
use App\Models\Accounts\User;
use App\Models\Classes\Classroom;
use App\Models\Subjects\Section;
use App\Models\Subjects\Subject;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'semester_id',
        'subject_id',
        'section_id',
        'teacher_id',
        'classroom_id',
        'test_name',
        'exam_type_id',
        'total_mark'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
