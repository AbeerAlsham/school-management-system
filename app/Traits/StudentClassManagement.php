<?php

namespace App\Traits;

use App\Models\Classes\StudyClass ;
use App\Models\studentClass;

trait StudentClassManagement
{
    public function promoteStudentToNewClass($studentClass, $newYear)
    {
        $newClassId = $this->getNextClassId($studentClass->study_class_id);
        studentClass::create([
            'student_id' => $studentClass->student_id,
            'study_class_id' => $newClassId,
            'study_year_id' => $newYear->id,
            'status' => 'مسجل'
        ]);
    }

    public function retainStudentInSameClass($studentClass, $newYear)
    {
        StudentClass::create([
            'student_id' => $studentClass->student_id,
            'study_class_id' => $studentClass->study_class_id,
            'study_year_id' => $newYear->id,
            'status' => 'مسجل'
        ]);
    }

    public function getNextClassId($currentClassId)
    {
        $nextClass = StudyClass::where('id', '>', $currentClassId)->orderBy('id')->first();
        return $nextClass ? $nextClass->id : $currentClassId;
    }
}
