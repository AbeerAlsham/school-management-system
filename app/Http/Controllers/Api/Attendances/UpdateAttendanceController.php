<?php

namespace App\Http\Controllers\Api\Attendances;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendences\UpdateAttendanceRequest;
use App\Models\Attendnce\Attendance;

class UpdateAttendanceController extends Controller
{
    public function __invoke(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance = $attendance->update($request->all());
        return $this->okResponse($attendance, 'the attendance have updated successfully');
    }
}
