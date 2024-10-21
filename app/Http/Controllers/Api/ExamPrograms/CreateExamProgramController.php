<?php

namespace App\Http\Controllers\Api\ExamPrograms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamPrograms\createExamProgramRequest;
use App\Jobs\SendNotificationExamProgramJob;
use App\Models\ExamProgram;

class CreateExamProgramController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(createExamProgramRequest $request)
    {
        $data = $request->all();

        // تحقق مما إذا كان هناك ملف مرفق
        if ($request->hasFile('file')) {
            $data['program_path'] = $request->file('file'); // احفظ الملف
        }
        $examProgram = ExamProgram::create($data);
        //send notification
        SendNotificationExamProgramJob::dispatch($examProgram);

        return $this->createdResponse($examProgram);
    }
}
