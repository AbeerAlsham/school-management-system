<?php

namespace App\Http\Controllers\Api\YearBooks;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\StudyYear;
use App\Models\Book\Book;
use Illuminate\Http\Request;

class getYearBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyYear $studyYear)
    {
        $yearBooks = Book::with(['yearBook' => function ($query) use ($studyYear) {
            $query->where('study_year_id', $studyYear->id);
        }])->get();
        return $this->okResponse($yearBooks, 'the year books retrieved successfully');
    }
}
