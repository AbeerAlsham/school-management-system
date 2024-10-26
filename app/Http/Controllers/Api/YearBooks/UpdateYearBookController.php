<?php

namespace App\Http\Controllers\Api\YearBooks;

use App\Http\Controllers\Controller;
use App\Models\YearBook;
use Illuminate\Http\Request;

class updateYearBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, YearBook $yearBook)
    {
        $yearBook->update($request->all());
        return $this->okResponse($yearBook,'the rear book updated successfully');
    }
}
