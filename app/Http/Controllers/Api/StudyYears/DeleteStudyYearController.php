<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use Illuminate\Http\Request;

class DeleteStudyYearController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,StudyYear $studyYear)
    {
        $studyYear->delete();
        $this->noContentResponse();
    }
}
