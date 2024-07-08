<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AssignSemesterUsersRequest;
use App\Models\AcademicYear\Semester;
use Illuminate\Http\Request;

class AssignSemesterUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignSemesterUsersRequest $request, Semester $semester)
    {
        $semester->UserRoles()->attach($request->user_role_ids);

        return $this->okResponse("the users assignment succefully");
    }
}
