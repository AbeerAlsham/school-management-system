<?php

namespace App\Models\Students;

use App\Models\LastSchoolInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'public_registry_number',
        'first_name', 'last_name', 'birthAddress', 'birthdate', 'registration_place', 'registration_number', 'religion', 'nationality',
        'Chronic diseases', 'national_number'
    ];

    public function father()
    {
        return $this->belongsTo(Father::class);
    }

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function siblings()
    {
        return $this->hasMany(Sibling::class);
    }

    public function address()
    {
        return $this->hasMany(ResidentialAaddress::class, 'student_id');
    }

    public function lastSchool()
    {
        return $this->hasOne(LastSchoolInfo::class, 'student_id');
    }
    
}
