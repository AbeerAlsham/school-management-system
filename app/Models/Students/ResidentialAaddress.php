<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentialAaddress extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'type', 'isliveParent', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
