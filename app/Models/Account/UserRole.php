<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicYear\Semester;

class UserRole extends Model
{
    protected $table = "users_roles";

    protected $fillable = ['user_id', 'role_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'semester_users')->withPivot(['id']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    //get user_role_id for any user (teacher,admin)
    public  static function getTeacher($semester_id, $role_name)
    {
        return  self::whereHas('role', function ($query) use ($role_name) {
            $query->where('name', $role_name);
        })->whereHas('semesters', function ($query) use ($semester_id) {
            $query->where('semesters.id', $semester_id);
        })->pluck('id')->toArray();
    }
    // get user_role_ids for student guardian
    public static function getStudentGuardian($student)
    {
        return self::whereHas('user', function ($query) use ($student) {
            $query->whereIn('id', $student->guardian->pluck('id')->toArray());
        })->pluck('id')->toArray();
    }
}
