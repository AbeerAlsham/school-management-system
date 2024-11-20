<?php

namespace App\Models\Note;

use App\Models\AssignmentStudent\studentClass;
use App\Models\AssignmentUser\semesterUser;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['note', 'student_class_id', 'semester_user_id'];

    public function studentClass()
    {
        return $this->belongsTo(studentClass::class);
    }

    public function semesterUser()
    {
        return $this->belongsTo(semesterUser::class);
    }
}
