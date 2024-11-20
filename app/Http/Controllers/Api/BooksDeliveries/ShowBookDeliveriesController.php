<?php

namespace App\Http\Controllers\Api\BooksDeliveries;

use App\Http\Controllers\Controller;
use App\Models\Book\BookDelivery as BookBookDelivery;
use App\Models\BookDelivery;
use Illuminate\Http\Request;

class ShowBookDeliveriesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, BookBookDelivery $bookDelivery)
    {
        return $this->okResponse($bookDelivery, 'the book delivery retrieved successfully');
    }
}
