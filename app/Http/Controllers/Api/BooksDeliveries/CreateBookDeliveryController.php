<?php

namespace App\Http\Controllers\Api\BooksDeliveries;

use App\Http\Controllers\Controller;
use App\Http\Requests\BooksDeliveries\CreateBookDeliveryRequest;
use App\Models\Book\Book;

class CreateBookDeliveryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateBookDeliveryRequest $request, Book $book)
    {
        foreach ($request->book_deliveries as $book_delivery) {
            $book_deliveries[] = $book->bookDeliveries()->create($book_delivery);
        }

        return $this->createdResponse($book_deliveries, 'the delivery book created successfully');
    }
}
