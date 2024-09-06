<?php

namespace App\Models;

use App\Models\AcademicYear\StudyYear;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Holiday extends Model
{
    protected $fillable = ['start_date', 'end_date', 'name', 'year_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function year()
    {
        return $this->belongsTo(StudyYear::class);
    }

    // public function isHoliday($date)
    // {
    //     $date = Carbon::parse($date);

    //     return $this->holidays()->whereBetween('start_date', [$date->startOfDay(), $date->endOfDay()])
    //         ->orWhereBetween('end_date', [$date->startOfDay(), $date->endOfDay()])
    //         ->exists();
    // }
}
