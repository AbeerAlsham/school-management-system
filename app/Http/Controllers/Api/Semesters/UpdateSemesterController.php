<?php

namespace App\Http\Controllers\Api\Semesters;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudyYears\updateSemesterRequest;
use App\Models\AcademicYear\Semester;

class UpdateSemesterController extends Controller
{   
    /**
     * Handle the incoming request.
     */
    public function __invoke(updateSemesterRequest $request ,Semester $semester)
    {
      $semester->update($request->all());

      return $this->okResponse(['semester'=>$semester],'semester updated successfully');
    }
}
