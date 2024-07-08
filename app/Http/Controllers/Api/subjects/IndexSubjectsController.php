<?php

namespace App\Http\Controllers\Api\subjects;

use App\Http\Controllers\Controller;
use App\Models\Subjects\Subject;
use Illuminate\Http\Request;

class IndexSubjectsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->okResponse(Subject::all(), 'subjects retrived successfully');
    }
}
