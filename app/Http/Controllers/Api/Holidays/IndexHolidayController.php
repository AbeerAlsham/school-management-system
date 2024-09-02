<?php

namespace App\Http\Controllers\Api\Holidays;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use Illuminate\Http\Request;

class IndexHolidayController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyYear $studyYear)
    {
        return $this->okResponse($studyYear->holidays, 'holidays rerieved successfully');
    }
}
