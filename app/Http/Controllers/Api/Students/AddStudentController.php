<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\AddStudentRequest;
use App\Models\Student\Sibling;
use App\Models\Student\Student;

class AddStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddStudentRequest $request)
    {
        $student = Student::create(($request->only([
            'photo', 'public_registry_number',
            'first_name', 'last_name', 'birth_address', 'birthdate',
            'registration_place', 'registration_number', 'religion',
            'nationality', 'chronic_diseases', 'national_number'
        ])));
        $student->address()->create($request->address);
        $student->Guardian()->attach($request->guardian['id'], ['kinship' => $request->guardian['kinship']]);
        $student->enrollement()->create($request->enrollement);
        $student->lastSchool()->create($request->lastSchool);
        $student->father()->create($request->father);
        $student->mother()->create($request->mother);
        $siblings  = array_map(function ($sibling) {
            return new Sibling($sibling);
        }, $request->siblings);
        $student->siblings()->saveMany($siblings);

        return $this->createdResponse($student, 'تم إضافة الطالب بنجاح ');
    }
}
