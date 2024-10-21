<?php

namespace App\Http\Controllers\Api\WeekPrograms;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeekPrograms\UpdateWeekProgramRequest;
use App\Jobs\SendNotificationWeekProgramJob;
use App\Models\WeekProgram;

class UpdateWeekProgramController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateWeekProgramRequest $request, WeekProgram $weekProgram)
    {
        if ($request->hasFile('file')) {
            $data = $request->file('file'); // احفظ الملف
        }
        $weekProgram->update(['program_path' => $data]);
        //send notification
        SendNotificationWeekProgramJob::dispatch($weekProgram);

        return $this->okResponse($weekProgram, 'the week prgram updated successfully');
    }
}
