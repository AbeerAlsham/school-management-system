<?php

namespace App\Http\Controllers\Api\subjects;

use App\Http\Controllers\Controller;
use App\Models\Classes\StudyClass;
use Illuminate\Http\Request;

class GetClassSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,StudyClass $class)
    {
       $subjects = $class->subjects()->with('sections')->get();
        return $this->okResponse($subjects,'class subjects retrived successfully');

    }
}
