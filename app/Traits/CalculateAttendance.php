<?php

namespace App\Traits;

use App\Models\Attendance;

trait CalculateAttendance
{
    public function calculateAttendanceCount($semester, $student)
    {
        $attendances = Attendance::where('semester_id', $semester->id)
            ->where('student_id', $student->id)->get();

        $total_days = $attendances->count();

        $present_days = $attendances ->where('status', 'حاضر')->count();

        $justified_days = $attendances->where('status', 'غائب')->where('is_justified', true)->count();

        $unjustified_days = $total_days - $present_days - $justified_days;

        return [

            'total_days_count' => $total_days,

            'present_days_count' => $present_days,

            'justified_days_count' => $justified_days,

            'unjustified_days_count' => $unjustified_days
        ];
    }
}
