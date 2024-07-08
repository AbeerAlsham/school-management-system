<?php

namespace App\Http\Controllers\Api\classrooms;
use App\Http\Controllers\Controller;
use App\Models\Classes\Classroom;
use App\Http\Requests\Classroom\CreateClassroomRequest;

class updateclassroomcontroller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateClassroomRequest $request,Classroom $classroom)
    {
        $classroom->update($request->all);
        return $this->okResponse($classroom ,'classroom updated successfully');
    }

}
