<?php

namespace App\Http\Controllers\Api\BooksDeliveries;

use App\Http\Controllers\Controller;
use App\Models\BookDelivery;
use Illuminate\Http\Request;

class DeleteBookDeliveryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, BookDelivery $bookDelivery)
    {
        $bookDelivery->delete();
        return $this->noContentResponse();
    }
}
