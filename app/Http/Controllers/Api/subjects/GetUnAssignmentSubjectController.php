<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Classes\StudyClass;
use Illuminate\Http\Request;
use App\Models\ClassSubject;

class GetUnAssignmentSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //الحصول على المواد التي لم يتعين عليها اساتذة ضمن شعبة معينة
    public function __invoke(Request $request, StudyClass $studyClass, Semester $semester)
    {
        $classSubjects = ClassSubject::where('class_id', $studyClass->id)
            ->whereDoesntHave('assignments', function ($query) use ($semester) {
                $query->where('semester_id', $semester->id)
                    ->whereNotNull('classroom_id');
            })
            ->with('sections', function ($query) use ($semester) {
                $query->whereDoesntHave('assignments', function ($query) use ($semester) {
                    $query->where('semester_id', $semester->id)
                        ->whereNotNull('classroom_id');
                });
            })
            ->get();

        return response()->json($classSubjects);
    }
}
