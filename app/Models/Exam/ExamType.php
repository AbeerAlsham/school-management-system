<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $fillable = ['name', 'percentage'];

    protected $hidden = ['created_at', 'updated_at'];

    public function exam()
    {
        return $this->hasMany(Exam::class,'exam_type_id');
    }
}
