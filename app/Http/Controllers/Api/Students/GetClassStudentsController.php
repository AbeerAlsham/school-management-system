<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\AcademicYear\StudyYear;
use App\Models\Classes\StudyClass;
use Illuminate\Http\Request;

class GetClassStudentsController extends Controller
{
    /**
     * Handle the incoming request.
     */

    //عرض طلاب صف معين خلال عام دراسي معين
    public function __invoke(Request $request, StudyYear $studyYear, StudyClass $studyClass)
    {
        $students = $studyClass->students()
            ->wherePivot('study_year_id', $studyYear->id)
            ->where('status',$request->status)
            ->get();

        return $this->okResponse(StudentResource::collection($students), 'students inside class have retrived successfully');
    }
}
