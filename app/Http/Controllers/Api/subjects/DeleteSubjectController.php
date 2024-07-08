<?php

namespace App\Http\Controllers\Api\subjects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subjects\Subject;
class DeleteSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Subject $subject)
    {
        $subject->delete();
       return  $this->noContentResponse();
    }
}
