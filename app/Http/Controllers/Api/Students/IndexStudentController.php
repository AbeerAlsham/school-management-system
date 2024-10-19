<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Models\Students\Student;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class IndexStudentController extends Controller
{
    use Searchable;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $students = Student::with('father');
         // تطبيق البحث إذا كانت موجودة
         if ($request->search) {
            $students = $this->Search($students, $request, ['first_name', 'last_name']);
        }

        return $this->okResponse($students->paginate(10), 'تم عرض الطلاب المسجلين في المدرسة بنجاح ');
    }
}
