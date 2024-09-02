<?php

namespace App\Models;

use App\Models\AcademicYear\StudyYear;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable=['start_date','end_date','name','year_id'];

    protected $hidden=['created_at','updated_at'];

    public function year(){
        return $this->belongsTo(StudyYear::class);
    }
}
