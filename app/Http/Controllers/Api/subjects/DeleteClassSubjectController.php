<?php

namespace App\Http\Controllers\Api\subjects;

use App\Http\Controllers\Controller;
use App\Models\Classes\StudyClass;
use App\Models\Subjects\Subject;
use Illuminate\Http\Request;

class DeleteClassSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyClass $class, Subject $subject)
    {
        $class->Subjects()->dettach($subject->id);
        return $this->noContentResponse();
    }
}
