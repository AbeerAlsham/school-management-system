<?php

namespace App\Http\Controllers\Api\Holidays;

use App\Http\Controllers\Controller;
use App\Http\Requests\Holidays\UpdateHolidayRequest;
use App\Models\AcademicYear\Holiday;

class UpdateHolidayController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateHolidayRequest $request, Holiday $holiday)
    {
        $holiday->update($request->all());
        return $this->okResponse('holiday updated successfully');
    }
}
