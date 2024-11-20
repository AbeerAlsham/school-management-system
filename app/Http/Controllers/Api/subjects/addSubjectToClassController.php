<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Class\StudyClass;
use App\Models\Subject\Subject;
use Illuminate\Http\Request;

class addSubjectToClassController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyClass $class, Subject $subject)
    {

        if ($request->section_ids) {
            foreach ($request->section_ids as $section_id) {
                $class->subjects()->attach($subject->id, ['section_id' => $section_id]);
            }
        } else {
            $class->subjects()->attach($subject->id);
        }

        return $this->createdResponse('section added to subject in class successfully');
    }
}
