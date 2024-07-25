<?php

namespace App\Http\Controllers\Api\Semesters;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Semester;
use Illuminate\Http\Request;

class ShowSemesterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Semester $semester)
    {
     return $this->okResponse(['semester'=>$semester],'semester retrived successfully');
    }
}
