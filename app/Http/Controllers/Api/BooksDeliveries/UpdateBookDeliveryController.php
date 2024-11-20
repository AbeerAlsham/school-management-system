<?php

namespace App\Http\Controllers\Api\BooksDeliveries;

use App\Http\Controllers\Controller;
use App\Http\Requests\BooksDeliveries\UpdateBookDeliveryRequest;
use App\Models\Book\BookDelivery;


class UpdateBookDeliveryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateBookDeliveryRequest $request)
    {
        $updatedBookDeliveries = [];

        foreach ($request->book_deliveries as $book_delivery) {
            $bookDelivery = BookDelivery::findOrFail($book_delivery['id']);
            $bookDelivery->update($book_delivery);
            $updatedBookDeliveries[] = $bookDelivery;
        }

        return $this->okResponse($updatedBookDeliveries, 'The book deliveries were updated successfully');
    }
}
