<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\UpdateSubjectRequest;
use App\Models\Subject\Subject;

class UpdateSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->all());
        return $this->okResponse($subject, 'the subject updated successfully');
    }
}
