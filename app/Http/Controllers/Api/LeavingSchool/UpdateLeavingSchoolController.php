<?php

namespace App\Http\Controllers\Api\LeavingSchool;

use App\Http\Controllers\Controller;
use App\Models\LeavingSchool;
use Illuminate\Http\Request;

class UpdateLeavingSchoolController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, LeavingSchool $leavingStudent)
    {
        $leavingStudent->update($request->all());

        return $this->okResponse($leavingStudent,'the data updated successfully');
    }
}
