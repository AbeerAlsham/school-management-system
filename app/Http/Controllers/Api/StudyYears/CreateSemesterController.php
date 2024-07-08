<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudyYears\createSemesterRequest;
use App\Models\AcademicYear\StudyYear;

class CreateSemesterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(createSemesterRequest $request,StudyYear $studyYear)
    {
        $semester=$studyYear->semesters()->create($request->all());
        return $this->createdResponse(['Semester' => $semester],'Semester added successfully');
    }

}
