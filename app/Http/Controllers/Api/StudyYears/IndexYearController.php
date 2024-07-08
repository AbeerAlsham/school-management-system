<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use Illuminate\Http\Request;

class IndexYearController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->okResponse(StudyYear::all(), 'academic_year retrived successfully');
    }
}
