<?php

namespace App\Http\Controllers\Api\WeekPrograms;

use App\Http\Controllers\Controller;
use App\Models\WeekProgram;
use Illuminate\Http\Request;

class ShowWeekProgramController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, WeekProgram $weekProgram)
    {
        return $this->okResponse($weekProgram, 'the week prgram retrieved successfully');
    }
}
