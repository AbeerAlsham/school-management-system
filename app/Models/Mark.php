<?php

namespace App\Models;

use App\Models\AcademicYear\Semester;
use App\Models\Students\Student;
use App\Models\Subjects\Section;
use App\Models\Subjects\Subject;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        'semester_id', 'student_id', 'subject_id', 'section_id',
        'mark_type_id', 'earned_mark', 'total_mark'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function studentClass()
    {
        return $this->belongsTo(studentClass::class);
    }

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

    public function markType()
    {
        return $this->belongsTo(MarkType::class);
    }
}
