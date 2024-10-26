<?php

namespace App\Http\Controllers\Api\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\UpdateBookRequest;
use App\Models\Book;

class UpdateBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->all());
        return $this->okResponse($book, 'the book updated successfully');
    }
}
