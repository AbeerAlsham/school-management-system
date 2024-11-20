<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Models\Class\Classroom;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class GetClassroomStudentsController extends Controller
{
    use Searchable;
    /**
     *  مع إمكانية البحث عرض طلاب شعبة معينة خلال عام دراسي معين
     */
    public function __invoke(Request $request, Classroom $Classroom)
    {
        $query = $Classroom->studentClassrooms()->with('studentClass.student.father')
            ->where('classroom_id', $Classroom->id);
        //search
        if ($request->search)
            $query->whereHas('studentClass.student', function ($q) use ($request) {
                return $this->Search($q, $request, ['first_name', 'last_name']);
            });
        return $this->okResponse($query->get(), 'the students retrieved successfully');
    }
}
