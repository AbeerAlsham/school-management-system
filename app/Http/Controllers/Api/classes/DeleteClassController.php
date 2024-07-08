<?php

namespace App\Http\Controllers\Api\Classes;

use App\Http\Controllers\Controller;
use App\Models\Classes\StudyClass;
use Illuminate\Http\Request;

class DeleteClassController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, StudyClass $class)
    {
        $class->delete();
        return $this->noContentResponse();
    }
}
