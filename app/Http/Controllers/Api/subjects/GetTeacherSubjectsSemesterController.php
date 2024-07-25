<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Classes\Classroom;
use App\Models\SemesterUser;
use Illuminate\Http\Request;
use App\Models\Subjects\Subject;

class GetTeacherSubjectsSemesterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, SemesterUser $semesterUser, Classroom $classroom)
    {

        // $SubjectAndSection = Subject::whereHas('assignmentTeachers', function ($query) use ($semesterUser, $classroom) {
        //     $query->where('semester_user_id', $semesterUser->id)->Where('classroom_id', $classroom->id);
        // })->with(['sections' => function ($query) use ($semesterUser, $classroom) {
        //     $query->whereHas('assignmentTeachers', function ($query) use ($semesterUser, $classroom) {
        //         $query->where('semester_user_id', $semesterUser->id)->Where('classroom_id', $classroom->id);
        //     });
        // }])->get();

        // return $this->okResponse($SubjectAndSection, 'subjects and sections  for teacher retrieved successfully');
    }
}
