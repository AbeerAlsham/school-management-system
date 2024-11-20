<?php

namespace App\Models\AssignmentUser;

use Illuminate\Database\Eloquent\Model;
use App\Models\Class\Classroom;

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
