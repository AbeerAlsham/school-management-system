<?php

namespace App\Models\AssignmentUser;

use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicYear\Semester;
use App\Models\Account\UserRole;
use App\Models\Exam\Exam;
use App\Models\Note\Note;
use App\Models\Notification\Notification;

class SemesterUser extends Model
{
    protected $fillable = ['semester_id', 'user_role_id'];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    public function assignmentTeachers(){
        return $this->hasMany(AssignmentTeacher::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class,'semester_user_id');
    }

    public function exams(){
        return $this->hasMany(Exam::class,'semester_user_id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'student_class_id');
    }
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
