<?php

namespace App\Http\Controllers\Api\Notes;

use App\Http\Controllers\Controller;
use App\Models\AssignmentStudent\studentClass;
use Illuminate\Http\Request;

class GetAllNoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, studentClass $studentClass)
    {
        $notes = $studentClass->notes()
            ->with('semesterUser.userRole.user.profile:first_name,last_name,user_id')->get();
        return $this->okResponse($notes, 'the notes retrieved successfully');
    }
}
