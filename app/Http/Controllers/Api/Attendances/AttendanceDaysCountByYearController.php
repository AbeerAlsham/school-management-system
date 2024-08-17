<?php

namespace App\Http\Controllers\Api\Attendances;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Models\Students\Student;
use Illuminate\Http\Request;
use App\Traits\CalculateAttendance;

class AttendanceDaysCountByYearController extends Controller
{
    use CalculateAttendance;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyYear $year, Student $student)
    {
        $results = [];
        foreach ($year->semesters as $semester) {
            $results[$semester->name] = [
                $this->calculateAttendanceCount($semester, $student)
            ];
        }
        return $this->okResponse($results);
    }
}
