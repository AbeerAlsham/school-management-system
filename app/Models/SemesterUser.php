<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicYear\Semester;

class SemesterUser extends Model
{
    protected $fillable = ['semester_id', 'user_role_id'];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
    public function userRoles()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }
}
