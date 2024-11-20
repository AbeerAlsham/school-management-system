<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear\Semester;
use App\Models\Class\StudyClass;

class GetUnRegisteredSupervisorsClassesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //عرض الصفوف والشعب التي لم يتعين عليها مشرفين
    public function __invoke(Request $request, Semester $semester)
    {
        $semesterId = $semester->id;

        $classroomsWithoutSupervisors = StudyClass::whereHas('classrooms', function ($query) use ($semesterId) {
            $query->whereDoesntHave('assignmentSupervisors', function ($query) use ($semesterId) {
                $query->whereHas('semesterUser', function ($query) use ($semesterId) {
                    $query->where('semester_id', $semesterId);
                });
            });
        })->with(['classrooms' => function ($query) use ($semesterId) {
            $query->whereDoesntHave('assignmentSupervisors', function ($query) use ($semesterId) {
                $query->whereHas('semesterUser', function ($query) use ($semesterId) {
                    $query->where('semester_id', $semesterId);
                });
            });
        }])->get();

        return $this->okResponse($classroomsWithoutSupervisors, 'classroom the not assignmnet supervisor retrieved successfully');
    }
}
