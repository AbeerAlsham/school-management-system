<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Models\Account\User;
use Illuminate\Http\Request;

class GetGuardinStudentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
       $students= $user->students()->get();
       return $this->okResponse($students,'تم عرض طلاب ولي الأمر بنجاح ');
    }
}
