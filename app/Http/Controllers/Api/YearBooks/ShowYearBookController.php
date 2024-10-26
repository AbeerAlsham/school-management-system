<?php

namespace App\Http\Controllers\Api\YearBooks;

use App\Http\Controllers\Controller;
use App\Models\YearBook;
use Illuminate\Http\Request;

class showYearBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, YearBook $yearBook)
    {
        return $this->okResponse($yearBook, 'the year book retrieved successfully');
    }
}
