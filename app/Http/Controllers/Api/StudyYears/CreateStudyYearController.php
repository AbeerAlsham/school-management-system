<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Http\Requests\StudyYears\CreateYearRequest;
use App\Jobs\AssignStudentsToNewClassJob;

class CreateStudyYearController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateYearRequest $request)
    {
        $academicYear = StudyYear::create($request->all());
        AssignStudentsToNewClassJob::dispatch($academicYear);

        return $this->createdResponse(['StudyYear' => $academicYear], 'StudyYear added successfully');
    }
}
