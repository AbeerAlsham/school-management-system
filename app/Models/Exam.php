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
        'semester_user_id',
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
    public function semesterUser()
    {
        return $this->belongsTo(SemesterUser::class, 'semester_user_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function marks()
    {
        return $this->hasMany(mark::class);
    }

    // change mark when change the total mark of exam
    public function updateMarks($newTotalMark)
    {
        $marks = $this->marks;
        foreach ($marks as $mark) {
            $percentage = $mark->earned_mark / $this->total_mark;
            $newMark = $percentage * $newTotalMark;
            $mark->update(['earned_mark' => $newMark]);
        }

        $this->update(['total_mark' => $newTotalMark]);
    }
}
