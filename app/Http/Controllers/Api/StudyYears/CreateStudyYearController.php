<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use App\Models\AcademicYear\StudyYear;
use App\Http\Requests\StudyYears\CreateYearRequest;

class CreateStudyYearController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateYearRequest $request)
    {
        $academicYear = StudyYear::create($request->all());

        // $semesters = array_map(function ($semester) {
        //     return new Semester($semester);
        // }, $request->semesters);
        // $academicYear->semesters()->saveMany($semesters);
        return $this->createdResponse(['StudyYear' => $academicYear], 'StudyYear added successfully');
    }
}
