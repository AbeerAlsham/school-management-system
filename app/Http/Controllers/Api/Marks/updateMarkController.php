<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Marks\UpdateMarkRequest;
use App\Models\Mark;

class updateMarkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateMarkRequest $request, Mark $mark)
    {
        if (!$request->can_update)
            return $this->unprocessableResponse('You cannot update the mark within 24 hours of its creation unless you are an admin.');
        $mark = $mark->update($request->all());
        return $this->okResponse($mark, 'the mark for student updated successfully');
    }
}
