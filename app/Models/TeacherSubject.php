<?php

namespace App\Models;

use App\Models\Accounts\User;
use App\Models\Subjects\Subject;
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
