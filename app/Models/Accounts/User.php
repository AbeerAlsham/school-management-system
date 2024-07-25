<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Classes\Classroom;
use App\Models\AcademicYear\Semester;
use App\Models\Subjects\Subject;
use App\Models\UserRole;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'pivot',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function hasRole($role_id)
    {
        return $this->roles()->where('id', $role_id)->exists();
    }

    public function classroom()
    {
        return $this->belongsToMany(Classroom::class, 'assignment_teachers', 'teacher_id', 'classroom_id')
            ->withPivot('section_id', 'subject_id', 'semester_id');
    }

    public function semester()
    {
        return $this->belongsToMany(Semester::class, 'assignment_teachers', 'teacher_id', 'semester_id')
            ->withPivot('section_id', 'subject_id', 'classroom_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects');
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class, 'user_id');
    }

    protected function casts(): array
    {
        return [

            'password' => 'hashed',
        ];
    }

    public function contactNumbers()
    {
        return $this->hasMany(ContactNumber::class,'user_id');
    }

    public function userRole(){
        return $this->hasMany(UserRole::class);
    }

}
