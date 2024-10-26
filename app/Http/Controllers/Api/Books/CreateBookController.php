<?php

namespace App\Http\Controllers\Api\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\createBookRequest;
use App\Models\ClassSubject;

class CreateBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(createBookRequest $request, ClassSubject $classSubject)
    {
        $books = [];
        foreach ($request->books as $book) {
            $books[] = $classSubject->books()->create($book);
        }

        return $this->createdResponse($book, 'the book created successfully');
    }
}
