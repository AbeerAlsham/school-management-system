<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SemesterUser;
use App\Models\Classes\StudyClass;
//الحصو لعى الصفوفو الشعب ل موجه معين
class GetSupervisorClassesController extends Controller
{
    public function __invoke(Request $request, SemesterUser $semesterUser)
    {
        $classesAndClassroom = StudyClass::whereHas('assignmentSupervisors', function ($query) use ($semesterUser,) {
            $query->where('semester_user_id', $semesterUser->id);
        })->with(['classrooms' => function ($query) use ($semesterUser) {
            $query->whereHas('assignmentSupervisors', function ($query) use ($semesterUser) {
                $query->where('semester_user_id', $semesterUser->id);
            });
        }])->get();


        $this->okResponse($classesAndClassroom, 'classes and classroom retrived succsessfully');
    }
}
