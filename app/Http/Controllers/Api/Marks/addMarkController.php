<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Marks\addMarkRequest;
use App\Jobs\SendNotificationExamMarkJob;
use App\Jobs\SendNotificationMarkTOGuardiansJob;
use App\Models\Exam;


class addMarkController extends Controller
{
    /**
     * اضافة علاماة لعدة طلاب
     */
    public function __invoke(addMarkRequest $request, Exam $exam)
    {
        if (!$this->isValid($exam))
            return $this->forbiddenResponse("لا يمكنك إضافة اختبار جديد بسبب انتهاء الفصل الدراسي");
        //التحقق من كون لفصل مفعل من أجل اضافة العلامة

        $marks = [];
        foreach ($request->marks as $mark) {
            if (in_array($exam->examType->name, ['شفهي', 'وظائف + أوراق عمل', 'نشاطات و مبادرات'])) {
                $mark['is_accepted'] = 1;
            }
            $marks[] = $exam->marks()->create($mark);
        }
        //send noti to guardian and admin
        $this->sendNotification($exam, $marks);

        return $this->createdResponse($marks, 'The marks assigned to students successfully');
    }

    public function isValid($exam)
    {
        if (!$exam->semester->is_current && !$exam->semester->is_opened)
            return false;
        else if (!$exam->semester->is_current && $exam->semester->is_opened)
            if ($exam->examType->name === 'امتحان الفصل')
                return true;
            else return false;
        else
            return false;
    }

    public function sendNotification($exam, $marks)
    {
        SendNotificationExamMarkJob::dispatch($exam);
        SendNotificationMarkTOGuardiansJob::dispatch($marks);
    }
}
