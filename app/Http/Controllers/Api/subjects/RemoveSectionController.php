<?php

namespace App\Http\Controllers\Api\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Subject\Section;
use Illuminate\Http\Request;

class RemoveSectionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Section $section)
    {
        $section->delete();
        return $this->noContentResponse();
    }
}
