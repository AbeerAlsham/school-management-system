<?php

namespace App\Http\Controllers\Api\Marks;

use App\Http\Controllers\Controller;
use App\Models\Exam\Exam;
use App\Models\Mark\mark;
use Illuminate\Http\Request;

class deleteMarkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Mark $mark)
    {
        $mark->delete();
        return $this->noContentResponse();
    }

    public function isAccess($mark){
        $isAdmin = request()->user()->roles()->where('name', 'مدير')->exists();
        $teacher_id = Exam::find($mark->exam_id)->teacher_id;
        $isAuth= request()->user()->id === $teacher_id ;

        return  $isAuth|| $isAdmin ;
    }

}
