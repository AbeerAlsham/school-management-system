<?php

namespace App\Models\Students;

use App\Models\LastSchoolInfo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\User;
use App\Models\enrollment;

class Student extends Model
{
    protected $fillable = [
        'image', 'public_registry_number',
        'first_name', 'last_name', 'birthAddress', 'birthdate', 'registration_place', 'registration_number', 'religion', 'nationality',
        'Chronic diseases', 'national_number'
    ];

    public function father()
    {
        return $this->hasOne(Father::class,'student_id');
    }

    public function mother()
    {
        return $this->hasOne(Mother::class,'student_id');
    }

    public function siblings()
    {
        return $this->hasMany(Sibling::class,'student_id');
    }

    public function address()
    {
        return $this->hasMany(ResidentialAaddress::class, 'student_id');
    }

    public function lastSchool()
    {
        return $this->hasOne(LastSchoolInfo::class, 'student_id');
    }

    public function Guardians()
    {
        return $this->belongsToMany(User::class)->withPivot('Kinship');
    }

    public function enrollement(){
        return $this->hasOne(enrollment::class,'student_id');
    }
}
