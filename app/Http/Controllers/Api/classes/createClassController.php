<?php

namespace App\Http\Controllers\Api\Classes;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudyClass\CreateClassRequest;
use App\Models\Class\StudyClass;

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
