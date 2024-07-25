<?php

namespace App\Http\Controllers\Api\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classes\Classroom;
use Illuminate\Http\Request;

class DeleteClassroomController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Classroom $classroom)
    {
        $classroom->delete();
        return $this->noContentResponse();
    }
}
