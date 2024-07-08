<?php

namespace App\Http\Controllers\Api\StudyYears;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use Illuminate\Http\Request;

class DeleteSemesterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester)
    {
        $semester->delete();
        return $this->noContentResponse();
    }
}
