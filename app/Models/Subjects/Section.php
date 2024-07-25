<?php

namespace App\Models\Subjects;

use App\Models\ClassSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name','subject_id'];
    protected $hidden = ['updated_at','created_at'];

    public function subject()
    {
        return $this->belongsTo(Subject::class,);
    }

    public function classSubjects(){
        return $this->hasMany(ClassSubject::class);
    }

   
}
