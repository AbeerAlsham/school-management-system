<?php

namespace App\Http\Controllers\Api\Attendances;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendences\AddAttendanceRequest;
use App\Models\Attendance;

class AddAttendanceController extends Controller
{
    public function __invoke(AddAttendanceRequest $request)
    {
        $attendance = Attendance::insert($request->attendances);
        
        return $this->createdResponse($attendance,'the students have assigned attendances successfully');
    }
}
