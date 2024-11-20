<?php

namespace App\Models\Account;

use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = ['first_name', 'father_name', 'last_name','user_id'];

    public function students(){
        return $this->belongsToMany(Student::class,'student_guardian')->withPivot('Kinship');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
