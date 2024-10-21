<?php

namespace App\Http\Controllers\Api\ExamPrograms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamPrograms\UpdateExamProgramRequest;
use App\Jobs\SendNotificationExamProgramJob;
use App\Models\ExamProgram;

class UpdateExamProgramController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateExamProgramRequest $request, ExamProgram $examProgram)
    {
        // تحقق مما إذا كان هناك ملف مرفق
        if ($request->hasFile('file')) {
            $data = $request->file('file'); // احفظ الملف
        }
        $examProgram->update(['program_path' => $data]);
        //send notification
        SendNotificationExamProgramJob::dispatch($examProgram);
        return $this->okResponse($examProgram, 'the examprogram updated successfully');
    }
}
