<?php

namespace App\Http\Controllers\Api\classrooms;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Models\Classes\StudyClass;
use Illuminate\Http\Request;

class GetClassroomByClassController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyYear $studyYear, StudyClass $Class)
    {
        $classroom = $Class->classrooms()->where('year_id', $studyYear->id)->get();
        return $this->okResponse($classroom, 'classrooms retrived successfully');
    }
}
