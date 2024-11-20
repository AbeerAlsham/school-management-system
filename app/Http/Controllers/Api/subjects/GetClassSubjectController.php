<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Class\StudyClass;
use Illuminate\Http\Request;

class GetClassSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyClass $class)
    {
        $subjects = $class->subjects()->with(['sections' => function ($query) use ($class) {
            $query->whereHas('classSubjects', function ($query) use ($class) {
                $query->where('class_id', $class->id);
            });
        }])->get();

        return $this->okResponse($subjects, 'class subjects retrived successfully');
    }
}
