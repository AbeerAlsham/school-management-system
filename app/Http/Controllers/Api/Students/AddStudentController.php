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
        $student->address()->create($request->address);
        $student->father()->firstOrCreate($request->father);
        $student->mother()->firstOrCreate($request->mother);
        $siblings  = array_map(function ($sibling) {
            return new Sibling($sibling);
        }, $request->siblings);
        $student->siblings()->saveMany($siblings);
    }
}
