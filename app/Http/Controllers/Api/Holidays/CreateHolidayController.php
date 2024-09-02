<?php

namespace App\Http\Controllers\Api\Holidays;

use App\Http\Controllers\Controller;
use App\Http\Requests\Holidays\CreateHolidayRequest;
use App\Models\AcademicYear\StudyYear;

class CreateHolidayController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateHolidayRequest $request, StudyYear $studyYear)
    {
        $holidays = [];
        foreach ($request->holidays as $holiday) {
            $holidays[]= $studyYear->holidays()->create($holiday);
        }

        return $this->createdResponse($holidays, 'holidays created successfully');
    }
}
