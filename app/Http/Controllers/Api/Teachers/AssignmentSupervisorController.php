<?php

namespace App\Http\Controllers\Api\Teachers;

use App\Http\Controllers\Controller;
use App\Models\AssignmentSupervisor;
use Illuminate\Http\Request;

class AssignmentSupervisorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //تعيين الموجه على الصفوف و الشعب
    public function __invoke(Request $request)
    {
        $assign_supervisor = AssignmentSupervisor::create($request->all());
        return $this->okResponse($assign_supervisor, 'the supervisor assigned on classes and classroom successfully');
    }
}
