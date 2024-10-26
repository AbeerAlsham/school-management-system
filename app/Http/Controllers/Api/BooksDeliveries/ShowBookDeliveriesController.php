<?php

namespace App\Http\Controllers\Api\BooksDeliveries;

use App\Http\Controllers\Controller;
use App\Models\BookDelivery;
use Illuminate\Http\Request;

class ShowBookDeliveriesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, BookDelivery $bookDelivery)
    {
        return $this->okResponse($bookDelivery, 'the book delivery retrieved successfully');
    }
}
