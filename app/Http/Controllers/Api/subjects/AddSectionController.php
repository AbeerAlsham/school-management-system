<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\AddSectionRequest;
use App\Models\Subject\Subject;

class AddSectionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddSectionRequest $request, Subject $subject)
    {
        $subject->sections()->create($request->all()); //

        return $this->okResponse($subject->load('sections'), 'the section added to subject successfully');
    }
}
