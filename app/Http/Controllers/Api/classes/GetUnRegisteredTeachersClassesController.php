<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\Classes\StudyClass;
use Illuminate\Http\Request;

class GetUnRegisteredTeachersClassesController extends Controller
{
//عرض الصفوف و الشعب التي ام يتعين عليها معلمين
public function __invoke(Request $request, Semester $semester)
{
    $semesterId = $semester->id;

    $classroomsWithoutSupervisors = StudyClass::whereDoesntHave('assignmentTeachers', function ($query) use ($semesterId) {
            $query->whereHas('semesterUser', function ($query) use ($semesterId) {
                $query->where('semester_id', $semesterId);
            });
        })->with(['classrooms' => function ($query) use ($semesterId) {
        $query->whereDoesntHave('assignmentTeachers', function ($query) use ($semesterId) {
            $query->whereHas('semesterUser', function ($query) use ($semesterId) {
                $query->where('semester_id', $semesterId);
            });
        });
    }])->get();

    return $this->okResponse($classroomsWithoutSupervisors, 'classroom the not assignmnet teacher retrieved successfully');
}
}
