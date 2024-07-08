<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear\Semester;
use Illuminate\Http\Request;

class AssignSemesterUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester)
    {
        $semester->userRoles()->attach($request->user_role_ids);
        return $this->okResponse('the teaches assigned to semester successfully');
    }
}
