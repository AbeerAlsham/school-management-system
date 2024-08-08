<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Models\Classes\Classroom;
use App\Http\Resources\StudentClassroomResource;
use Illuminate\Http\Request;

class GetClassroomStudentsController extends Controller
{
    /**
     * عرض طلاب شعبة معينة خلال عام دراسي معين
     */
    public function __invoke(Request $request,Classroom $Classroom)
    {
        $studentClassrooms= $Classroom->studentClassrooms()->with('studentClass.student')
        ->where('classroom_id',$Classroom->id)->get();
        $student= StudentClassroomResource::collection($studentClassrooms);
        return $this->okResponse($student);
    }
}
