<?php

namespace App\Http\Controllers\Api\classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classroom\CreateClassroomRequest;
use App\Models\AcademicYear\StudyYear;

class createClassroomController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(createClassroomRequest $request, StudyYear $studyYear)
    {
        $classroom = $studyYear->classroom()->create($request->all());
        return  $this->createdResponse($classroom, 'classroom added successfully');
    }
}
