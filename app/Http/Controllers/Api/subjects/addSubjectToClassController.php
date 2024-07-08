<?php

namespace App\Http\Controllers\Api\subjects;

use App\Http\Controllers\Controller;
use App\Models\Classes\StudyClass;
use App\Models\Subjects\Subject;
use App\Models\Subjects\Section;
use Illuminate\Http\Request;

class addSubjectToClassController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyClass $class, Subject $subject)
    {

            $class->subjects()->attach($subject->id, ['section_id' => $request->section_ids]);


        return $this->createdResponse('section added to subject in class successfully');
    }
}
