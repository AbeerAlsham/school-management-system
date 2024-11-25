<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\UpdateSectiontRequest;
use App\Models\Subject\Section;

class UpdateSectionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateSectiontRequest $request, Section $section)
    {
        $section->update($request->all());
        return $this->okResponse($section, 'the section updated successfully');
    }
}
