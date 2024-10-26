<?php

namespace App\Http\Controllers\Api\BooksDeliveries;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use App\Models\studentClass;
use Illuminate\Http\Request;

class GetStudentBookDeliveriesController extends Controller
{
    /**
     *  ما عرض حالة جميع الكتب الدراسية من اجل  طالب
     */
    public function __invoke(Request $request, StudentClass $studentClass)
    {
        // جلب المواد الدراسية المرتبطة بالصف
        $classSubjects = ClassSubject::where('class_id', $studentClass->study_class_id)
            ->with(['books.bookDeliveries' => function ($query) use ($studentClass) {
                $query->where('student_class_id', $studentClass->id);
            }])->get();

        // استخراج الكتب من المواد الدراسية
        $books = $classSubjects->pluck('books')->flatten();

        return $this->okResponse($books, 'The books retrieved successfully');
    }
}
