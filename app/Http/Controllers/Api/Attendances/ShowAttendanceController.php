<?php

namespace App\Http\Controllers\Api\Attendances;

use App\Http\Controllers\Controller;
use App\Models\Attendnce\Attendance;
use Illuminate\Http\Request;

class ShowAttendanceController extends Controller
{
    public function __invoke(Request $request, Attendance $attendance)
    {

        return $this->okResponse($attendance->load('student'),'the attendance retrieved successfully');
    }

}
