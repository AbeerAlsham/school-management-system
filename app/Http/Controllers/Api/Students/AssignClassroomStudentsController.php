<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\AssignClassroomStudentsRequest;
use App\Models\studentClassroom;

//تسجيل الطلاب ضمن شعبة دراسية
class AssignClassroomStudentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignClassroomStudentsRequest $request)
    {
        foreach ($request->student_class_ids as $student_class_id) {
            studentClassroom::create([
                'student_class_id' => $student_class_id,
                'classroom_id' => $request->classroom_id,
            ]);
        }
        return $this->okResponse('the student added to classroom successfully');
    }
}
