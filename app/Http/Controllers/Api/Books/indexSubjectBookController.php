<?php

namespace App\Http\Controllers\Api\Books;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use Illuminate\Http\Request;

class indexSubjectBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ClassSubject $classSubject)
    {
        $books = $classSubject->books;
        return $this->okResponse($books, 'the books retrieved successfully');
    }
}
