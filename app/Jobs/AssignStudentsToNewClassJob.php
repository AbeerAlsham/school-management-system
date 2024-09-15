<?php

namespace App\Jobs;

use App\Enums\StudentStatus;
use App\Models\AcademicYear\StudyYear;
use App\Models\studentClass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Traits\StudentClassManagement;

class AssignStudentsToNewClassJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, StudentClassManagement;

    protected $newYear;

    public function __construct($newYear)
    {
        $this->newYear = $newYear;
    }

    public function handle()
    {
        $previousYear = StudyYear::latest('id')->skip(1)->first();
        $students = studentClass::where('study_year_id', $previousYear->id)->get();

        foreach ($students as $studentClass) {
            $status = $studentClass->status;

            if ($status == StudentStatus::ناجح->value) {
                $this->promoteStudentToNewClass($studentClass, $this->newYear);
            } elseif ($status == StudentStatus::راسب->value) {
                $this->retainStudentInSameClass($studentClass, $this->newYear);
            }
        }
    }
}
