<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SemesterUser;
use App\Models\Classes\StudyClass;
use App\Models\Subjects\Subject;

class GetTeacherClassesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //الحصول على الصفوف و الشعب التي يدرسها معلم ضمن الفصل الدراسي
    public function __invoke(Request $request, SemesterUser $semesterUser, Subject $subject)
    {
        $classesAndClassroom = StudyClass::whereHas('assignmentTeachers', function ($query) use ($semesterUser, $subject) {
            $query->where('subject_id', $subject->id)
                ->where('semester_user_id', $semesterUser->id);
        })->with(['classrooms' =>  function ($query) use ($semesterUser, $subject) {
            $query->whereHas('assignmentTeachers', function ($query) use ($semesterUser, $subject) {
                $query->where('subject_id', $subject->id)
                    ->where('semester_user_id', $semesterUser->id);
            });
        }])->get();

        return $this->okResponse($classesAndClassroom, 'classes and classroom retrived succsessfully');
    }
}
