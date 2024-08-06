<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Models\Students\Student;
use Illuminate\Http\Request;

class IndexStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $students = Student::with('father')->all()->paginate(10);
        return $this->okResponse($students, 'تم عرض الطلاب المسجلين في المدرسة بنجاح ');
    }
}
