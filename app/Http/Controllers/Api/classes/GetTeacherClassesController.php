<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SemesterUser;
use App\Models\Classes\StudyClass;
use App\Models\Subjects\Section;
use App\Models\Subjects\Subject;

class GetTeacherClassesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //الحصول على الصفوف و الشعب التي يدرسها معلم ضمن الفصل الدراسي
    public function __invoke(Request $request, SemesterUser $semesterUser)
    {
        if ($request->section_id)
            $classesAndClassroom = StudyClass::whereHas('assignmentTeachers', function ($query) use ($semesterUser, $request) {
                $query->where('section_id', $request->section_id)
                    ->where('semester_user_id', $semesterUser->id);
            })->with(['classrooms' =>  function ($query) use ($semesterUser, $request) {
                $query->whereHas('assignmentTeachers', function ($query) use ($semesterUser, $request) {
                    $query->where('section_id', $request->section_id)
                        ->where('semester_user_id', $semesterUser->id);
                });
            }])->get();

        else if ($request->subject_id)
            $classesAndClassroom = StudyClass::whereHas('assignmentTeachers', function ($query) use ($semesterUser, $request) {
                $query->where('subject_id', $request->subject_id)
                    ->where('semester_user_id', $semesterUser->id);
            })->with(['classrooms' =>  function ($query) use ($semesterUser, $request) {
                $query->whereHas('assignmentTeachers', function ($query) use ($semesterUser, $request) {
                    $query->where('subject_id', $request->subject_id)
                        ->where('semester_user_id', $semesterUser->id);
                });
            }])->get();
        // else $classesAndClassroom = [];
        return $this->okResponse($classesAndClassroom, 'classes and classroom retrived succsessfully');
    }
}
