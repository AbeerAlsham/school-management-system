<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'last_name',
        'parent_name',
        'study_level',
        'work'
    ];

    public function students()
    {
        return $this->hasMany(Father::class, 'student_id');
    }
}
