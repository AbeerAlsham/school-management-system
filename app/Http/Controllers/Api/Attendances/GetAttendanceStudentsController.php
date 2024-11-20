<?php

namespace App\Http\Controllers\Api\Attendances;

use App\Http\Controllers\Controller;
use App\Models\Class\Classroom;
use Illuminate\Http\Request;

class GetAttendanceStudentsController extends Controller
{
    /**
     * عرض طلاب شعبة معينة مع حضورهم في تاريخ محدد
     */
    public function __invoke(Request $request, Classroom $classroom)
    {
        $attandances = $classroom->studentClassroom
        ->with('attendances', function ($query) use ($request) {
            $query->where('date', $request->date);
        });

        return $this->okResponse($attandances, 'attendances retrieved successfully for classroom students');
    }
}
