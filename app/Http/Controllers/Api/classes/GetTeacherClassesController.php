<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use Illuminate\Http\Request;
use App\Models\Accounts\User;
use App\Models\SemesterUser;
use App\Models\Classes\StudyClass;

class GetTeacherClassesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester, User $user)
    {
        $classesAndClassroom = StudyClass::whereHas('assignmentTeachers', function ($query) use ($semester, $user) {
            $query->whereHas('semesterUser', function ($q) use ($semester, $user) {
                $q->where('semester_id', $semester->id)
                   ->whereHas('userRoles', function ($qr) use ($user) {
                       $qr->where('user_id', $user->id);
                   });
            });
        })->with(['classrooms' => function ($query) use ($semester, $user) {
            $query->whereHas('assignmentTeachers', function ($query) use ($semester, $user){
            $query->whereHas('semesterUser', function ($q) use ($semester, $user) {
                $q->where('semester_id', $semester->id)
                   ->whereHas('userRoles', function ($qr) use ($user) {
                       $qr->where('user_id', $user->id);
                   });
            });});}])->get();

       return $this->okResponse($classesAndClassroom, 'classes and classroom retrived succsessfully');
    }
}
