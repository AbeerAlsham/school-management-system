<?php

namespace App\Models\AssignmentUser;

use App\Models\Account\User;
use App\Models\Subject\Subject;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $fillable = ['user_id', 'subject_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
