<?php

namespace App\Http\Controllers\Api\classes;

use App\Http\Controllers\Controller;
use App\Models\Classes\StudyClass;
use Illuminate\Http\Request;

class IndexClassesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
       return $this->okResponse(StudyClass::all(), 'classes retrived');
    }
}
