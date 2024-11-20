<?php

namespace App\Http\Controllers\Api\BooksDeliveries;

use App\Http\Controllers\Controller;
use App\Models\Book\Book;
use App\Models\Class\Classroom;
use Illuminate\Http\Request;

class GetClassroomBookDeliveriesController extends Controller
{
    /**
     * عرض الحالة لاستلام الكتاب  لطلاب شعبة معينة من احل كتاب معين
     */
    public function __invoke(Request $request, Classroom $classroom, Book $book)
    {
        foreach ($classroom->studentClassrooms as $student_classroom) {
            $book_deliveries[] = $student_classroom->studentClass()
                ->with([
                    'student:id,photo,first_name,last_name',
                    'bookDeliveries' => function ($query) use ($book) {
                        $query->where('book_id', $book->id);
                    }
                ])->first();
        }
        return $this->okResponse($book_deliveries, 'the book deliveries retrieved successfully');
    }
}
