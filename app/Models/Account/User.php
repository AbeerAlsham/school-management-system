<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Class\Classroom;
use App\Models\AcademicYear\Semester;
use App\Models\Exam\Exam;
use App\Models\Student\Student;
use App\Models\Subject\Subject;
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
        return $this->belongsToMany(Role::class, 'users_roles')->withPivot('id');
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
        return $this->hasMany(ContactNumber::class, 'user_id');
    }

    public function userRole()
    {
        return $this->hasMany(UserRole::class);
    }
    //for guardian
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_guardians', 'guardian_id', 'student_id')->withPivot('Kinship');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_id');
    }

    public function deviceTokens()
    {
        return $this->hasMany(UserDeviceToken::class, 'user_id');
    }

}
