<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Models\Students\Sibling;
use App\Models\Students\Student;
use Illuminate\Http\Request;

class AddStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $student = Student::create(($request->only([
            'image', 'public_registry_number',
            'first_name', 'last_name', 'birthAddress', 'birthdate', 'registration_place', 'registration_number', 'religion', 'nationality',
            'Chronic diseases', 'national_number'
        ])));
        $student->Guardian()->attach($request->gurdian->id, ['kinship' => $request->guardian->kinship]);
        $student->enrollement()->create($request->enrollment);
        $student->address()->create($request->address);
        $student->father()->create($request->father);
        $student->mother()->create($request->mother);
        $siblings  = array_map(function ($sibling) {
            return new Sibling($sibling);
        }, $request->siblings);
        $student->siblings()->saveMany($siblings);
    }
}
