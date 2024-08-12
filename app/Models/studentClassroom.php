<?php

namespace App\Models;

use App\Models\Classes\Classroom;
use Illuminate\Database\Eloquent\Model;

class studentClassroom extends Model
{
    protected $fillable = ['student_class_id', 'classroom_id', 'serial_number'];

    protected $hidden=['created_at','updated_at'];

    public function studentClass()
    {
        return $this->belongsTo(studentClass::class);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(
            function ($studentClassroom) {

                 $classroomCapacity = $studentClassroom->classroom()->first()->capacity;
                // السعة القصوى للشعبة
                $currentStudentCount = studentClassroom::where('classroom_id', $studentClassroom->classroom_id)->count();

                if ($currentStudentCount >= $classroomCapacity) {
                    throw new \Exception('The classroom capacity has been reached.');
                }
                $usedSerialNumbers = studentClassroom::where('classroom_id', $studentClassroom->classroom_id)
                    ->pluck('serial_number')
                    ->toArray();

                $serialNumber = 1;
                while (in_array($serialNumber, $usedSerialNumbers)) {
                    $serialNumber++;
                }

                $studentClassroom->serial_number = $serialNumber;
            }
        );
    }
}
