<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'study_level',
        'work'
    ];

    public function students()
    {
        return $this->hasMany(Mother::class, 'student_id');
    }
}

