<?php

namespace App\Http\Controllers\Api\Books;

use App\Http\Controllers\Controller;
use App\Models\Book\Book;
use Illuminate\Http\Request;

class DeleteBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Book $book)
    {
        $book->delete();
        return $this->noContentResponse();
    }
}
