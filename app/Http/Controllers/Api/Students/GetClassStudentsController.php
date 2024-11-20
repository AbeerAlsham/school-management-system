<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\AcademicYear\StudyYear;
use App\Models\Class\StudyClass;
use Illuminate\Http\Request;
use App\Traits\Searchable;

class GetClassStudentsController extends Controller
{
    use Searchable;

    /**
     * Handle the incoming request.
     */

    // عرض طلاب صف معين خلال عام دراسي معين
    public function __invoke(Request $request, StudyYear $studyYear, StudyClass $studyClass)
    {
        // بدء الاستعلام
        $studentsQuery = $studyClass->students()
            ->wherePivot('study_year_id', $studyYear->id);

        // فلترة بحسب الحالة إذا كانت موجودة
        if ($request->status) {
            $studentsQuery->where('status', $request->status);
        }

        // تطبيق البحث إذا كانت موجودة
        if ($request->search) {
            $studentsQuery = $this->Search($studentsQuery->getQuery(), $request, ['first_name', 'last_name']);
        }

        return $this->okResponse(StudentResource::collection($studentsQuery->get()), 'تم استرجاع الطلاب بنجاح');
    }
}
