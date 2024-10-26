<?php

namespace App\Http\Controllers\Api\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class ShowBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Book $book)
    {
        return $this->okResponse($book, 'the book retrieved successfully');
    }
}
