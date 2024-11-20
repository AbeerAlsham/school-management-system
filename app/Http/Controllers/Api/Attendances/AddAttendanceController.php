<?php

namespace App\Http\Controllers\Api\Attendances;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendences\AddAttendanceRequest;
use App\Models\Attendance\Attendance;

class AddAttendanceController extends Controller
{
    public function __invoke(AddAttendanceRequest $request)
    {
        $attendances=[];
        foreach ($request->attendances as $attendance){
            $attendance= Attendance::create($attendance);
            $attendance->makeHidden(['student']); // إخفاء علاقة الطالب
            $attendances[] = $attendance;}

        return $this->createdResponse($attendances, 'the students have assigned attendances successfully');
    }
}
