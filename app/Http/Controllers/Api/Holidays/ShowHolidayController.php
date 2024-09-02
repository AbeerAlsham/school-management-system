<?php

namespace App\Http\Controllers\Api\Holidays;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class ShowHolidayController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Holiday $holiday)
    {
        return $this->okResponse($holiday, 'the holiday retrieved successfully');
    }
}
