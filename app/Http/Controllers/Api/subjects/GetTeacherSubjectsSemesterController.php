<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\SemesterUser;
use Illuminate\Http\Request;
use App\Models\Subjects\Subject;

class GetTeacherSubjectsSemesterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //الحصول على المواد و لاقسام التي يدرسها معلم ضمن فصل معي
    public function __invoke(Request $request, SemesterUser $semesterUser)
    {
        $SubjectAndSection = Subject::whereHas('assignmentTeachers', function ($query) use ($semesterUser) {
            $query->where('semester_user_id', $semesterUser->id);
        })->with(['sections' => function ($query) use ($semesterUser) {
            $query->whereHas('assignmentTeachers', function ($query) use ($semesterUser) {
                $query->where('semester_user_id', $semesterUser->id);
            });
        }])->get();

        return $this->okResponse($SubjectAndSection, 'subjects and sections  for teacher retrieved successfully');
    }
}
