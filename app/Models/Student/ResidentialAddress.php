<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class ResidentialAddress extends Model
{
    protected $table = "residential_address";
    protected $fillable = ['address', 'type', 'isLiveParent', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
