<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Classes\{StudyClass, Classroom};
use Illuminate\Http\Request;
use App\Models\ClassSubject;
use App\Models\Subjects\Subject;

class GetUnAssignmentSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //الحصول على المواد التي لم يتعين عليها اساتذة ضمن شعبة معينة
    public function __invoke(Request $request, Semester $semester, StudyClass $class, Classroom $classroom)
    {
        $class_subjects = ClassSubject::where('class_id', $class->id)->get();
        $subject_ids = $class_subjects->pluck('subject_id');
        $section_ids = $class_subjects->pluck('section_id');
        $classSubjects = Subject::whereIn('id', $subject_ids)
            ->whereDoesntHave('assignmentTeachers', function ($query) use ($semester, $classroom) {
                $query->whereHas('semesterUser', function ($query) use ($semester) {
                    $query->where('semester_id', $semester->id);
                })->where('classroom_id', $classroom->id);
            })->with('sections')
            ->whereDoesntHave('assignmentTeachers', function ($query) use ($semester, $classroom) {
                $query->whereHas('semesterUser', function ($query) use ($semester) {
                    $query->where('semester_id', $semester->id);
                })->where('classroom_id', $classroom->id);
            })->get();

        return $this->okResponse($classSubjects, 'the subject retrived successfully');
    }
}
