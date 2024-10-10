<?php

namespace App\Http\Controllers\Api\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\SemesterUser;
use App\Models\studentClass;
use Illuminate\Http\Request;

class GetTeacherNotesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, studentClass $studentClass, SemesterUser $semesterUser)
    {
        $notes = Note::where('student_class_id', $studentClass->id)
            ->where('semester_user_id', $semesterUser->id)->get();
        return $this->okResponse($notes, 'the notes retrieved successfully');
    }
}
