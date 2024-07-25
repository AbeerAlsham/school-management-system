<?php

namespace App\Http\Controllers\Api\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classes\Classroom;
use App\Http\Requests\Classroom\CreateClassroomRequest;

class updateclassroomcontroller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateClassroomRequest $request, Classroom $classroom)
    {

        $classroom->name = $request['name']?? $classroom->name ;
        $classroom->capacity = $request['capacity']??$classroom->capacity;
        $classroom->save();
        return $this->okResponse($classroom, 'classroom updated successfully');
    }
}
