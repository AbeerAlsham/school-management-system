<?php

namespace App\Http\Controllers\Api\WeekPrograms;

use App\Http\Controllers\Controller;
use App\Models\Document\WeekProgram;
use Illuminate\Http\Request;

class DeleteWeekProgramController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, WeekProgram $weekProgram)
    {
        $weekProgram->delete();
        return $this->noContentResponse();
    }
}
