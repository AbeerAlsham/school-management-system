<?php

namespace App\Http\Controllers\Api\Attendances;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Attendance;
use App\Models\Students\Student;
use Illuminate\Http\Request;
use App\Traits\CalculateAttendance;

class AttendanceDaysCountBySemesterController extends Controller
{

    use CalculateAttendance;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester, Student $student)
    {
       $result= $this->calculateAttendanceCount($semester, $student);

       return $this->okResponse($result);
    }
}
