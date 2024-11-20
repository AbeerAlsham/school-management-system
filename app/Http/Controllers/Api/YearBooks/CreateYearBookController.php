<?php

namespace App\Http\Controllers\Api\YearBooks;

use App\Http\Controllers\Controller;
use App\Http\Requests\YearBooks\CreateYearBookRequest;
use App\Models\Book\YearBook;

class createYearBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateYearBookRequest $request)
    {
        $bookYear = YearBook::create($request->all());
        return $this->createdResponse($bookYear, 'the book in year created successfully');
    }
}
