<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudyYears\UpdateYearRequest;
use App\Models\AcademicYear\StudyYear;

class UpdateStudyYearController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateYearRequest $request,StudyYear $studyYear)
    {
        $studyYear->update($request->all());
        return $this->okResponse(['StudyYear' => $studyYear], 'studyYear updated successfully');
    }
}
