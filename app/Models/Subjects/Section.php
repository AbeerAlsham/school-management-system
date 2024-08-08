<?php

namespace App\Models\Subjects;

use App\Models\ClassSubject;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $fillable = ['name','subject_id','max_mark'];
    protected $hidden = ['updated_at','created_at'];

    public function subject()
    {
        return $this->belongsTo(Subject::class,);
    }

    public function classSubjects(){
        return $this->hasMany(ClassSubject::class);
    }

    public function marks(){
        return $this->hasMany(Mark::class);
    }

}
