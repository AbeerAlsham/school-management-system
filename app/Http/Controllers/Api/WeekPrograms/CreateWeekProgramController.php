<?php

namespace App\Http\Controllers\Api\WeekPrograms;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeekPrograms\CreateWeekProgramRequest;
use App\Jobs\SendNotificationWeekProgramJob;
use App\Models\AcademicYear\Semester;
use App\Models\UserRole;
use App\Models\WeekProgram;
use App\Services\NotificationService;

class CreateWeekProgramController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateWeekProgramRequest $request)
    {
        $data = $request->all();
        // تحقق مما إذا كان هناك ملف مرفق
        if ($request->hasFile('file')) {
            $data['program_path'] = $request->file('file'); // احفظ الملف
        }
        $weekProgram = WeekProgram::create($data);
        //send notification
        SendNotificationWeekProgramJob::dispatch($weekProgram);

        return $this->createdResponse($weekProgram, 'the week program created successfully');
    }
}
