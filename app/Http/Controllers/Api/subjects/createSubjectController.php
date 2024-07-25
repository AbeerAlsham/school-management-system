<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\CreateSubjectRequest;
use App\Models\Subjects\{Subject, Section};

class createSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateSubjectRequest $request)
    {
        $subject = Subject::create($request->only('name'));
        if ($request->sections) {
            $sections = array_map(function ($section) {
                return new Section($section);
            }, $request->sections);
            $subject->sections()->saveMany($sections);
        }
        return  $this->createdResponse($subject, 'subject added successfully');
    }
}
