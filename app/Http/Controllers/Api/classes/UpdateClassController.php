<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use App\Models\Classes\StudyClass;
use App\Http\Requests\StudyClass\CreateClassRequest;

class updateClasscontroller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateClassRequest  $request,StudyClass $class)
    {
        $class->update($request->all());
        return $this->okResponse($class, 'class updated successfully');
    }
}
