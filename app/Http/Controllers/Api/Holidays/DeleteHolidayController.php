<?php

namespace App\Http\Controllers\Api\Holidays;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear\Holiday;
use Illuminate\Http\Request;

class DeleteHolidayController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Holiday $holiday)
    {
        $holiday->delete();

        return $this->noContentResponse();
    }
}
