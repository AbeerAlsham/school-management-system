<?php

namespace App\Models\Students;

use App\Models\LastSchoolInfo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\User;
use App\Models\studentClass;
use App\Models\Students\enrollment;

class Student extends Model
{
    protected $fillable = [
        'photo', 'public_registry_number', 'first_name', 'last_name',
        'birth_address', 'birthdate', 'registration_place', 'registration_number',
        'religion', 'nationality', 'chronic_diseases', 'national_number'
    ];

    public function father()
    {
        return $this->hasOne(Father::class, 'student_id');
    }

    public function mother()
    {
        return $this->hasOne(Mother::class, 'student_id');
    }

    public function siblings()
    {
        return $this->hasMany(Sibling::class, 'student_id');
    }

    public function address()
    {
        return $this->hasMany(ResidentialAddress::class, 'student_id');
    }

    public function lastSchool()
    {
        return $this->hasOne(LastSchoolInfo::class, 'student_id');
    }

    public function Guardian()
    {
        return $this->belongsToMany(User::class, 'student_guardians', 'student_id', 'guardian_id')->withPivot('Kinship');
    }

    public function enrollement()
    {
        return $this->hasOne(enrollment::class, 'student_id');
    }

    public function studentClasses()
    {
        return $this->hasMany(studentClass::class);
    }

    public function setPhotoAttribute($file)
    {
        $filePath = 'students/';
        $uniqueFileName = md5(time()) . '.' . $file->getClientOriginalName();

        $this->attributes['photo'] = $file->storeAs($filePath, $uniqueFileName, 'public');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($student) {
            unlink(storage_path('app/' . $student->photo));
        });
    }
}
