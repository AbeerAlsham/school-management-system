<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use App\Models\AssignmentUser\SemesterUser;
use App\Models\Class\StudyClass;
use Illuminate\Http\Request;


class GetTeacherClassesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //الحصول على الصفوف و الشعب التي يدرسها معلم ضمن الفصل الدراسي
    public function __invoke(Request $request, SemesterUser $semesterUser)
    {
        $classesAndClassroom = StudyClass::whereHas('assignmentTeachers', function ($query) use ($semesterUser, $request) {
            $query->where('section_id', $request->section_id)
                ->orWhere('subject_id', $request->subject_id)
                ->where('semester_user_id', $semesterUser->id);
        })->with(['classrooms' =>  function ($query) use ($semesterUser, $request) {
            $query->whereHas('assignmentTeachers', function ($query) use ($semesterUser, $request) {
                $query->where('section_id', $request->section_id)
                    ->orWhere('subject_id', $request->subject_id)
                    ->where('semester_user_id', $semesterUser->id);
            });
        }])->get();

        return $this->okResponse($classesAndClassroom, 'classes and classroom retrived succsessfully');
    }
}
