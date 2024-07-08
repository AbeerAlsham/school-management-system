<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes\Classroom;

class AssignmentTeacher extends Model
{
    use HasFactory;

    protected $table = 'assignment_teachers';

    protected $fillable = [
        'semster_user_id',
        'class_subject_id',
        'classroom_id',
    ];

    public function semesterUser()
    {
        return $this->belongsTo(SemesterUser::class, 'semester_user_id');
    }
    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class, 'class_subject_id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
