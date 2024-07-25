<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classes\Classroom;

class AssignmentTeacher extends Model
{
    protected $table = 'assignment_teachers';

    protected $fillable = [
        'semester_user_id',
        'class_id',
        'subject_id',
        'section_id',
        'classroom_id',
    ];

    public function semesterUser()
    {
        return $this->belongsTo(SemesterUser::class, 'semester_user_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
