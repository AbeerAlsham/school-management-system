<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Class\StudyClass;
use App\Models\Subject\Subject;
use Illuminate\Http\Request;

class DeleteClassSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyClass $class, Subject $subject)
    {
        $class->Subjects()->detach($subject->id);
        return $this->noContentResponse();
    }
}
