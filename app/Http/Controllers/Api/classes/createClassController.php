<?php

namespace App\Http\Controllers\Api\classes;
use App\Http\Controllers\Controller;
use App\Models\Classes\StudyClass;
use App\Http\Requests\StudyClass\CreateClassRequest;

class createClassController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateClassRequest  $request)
    {
        $class = StudyClass::create($request->all());
        return $this->createdResponse($class, 'class added successfully');
    }
}
