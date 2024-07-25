<?php

namespace App\Http\Controllers\APi\Subjects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\User;

class GetTeacherSubjectsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        if ($this->checkAccess($user))
            return $this->okResponse($user->subjects, 'the teacher subjects retrived successfully');
        return $this->unprocessableResponse('the user have not teacher role');
    }

    public function checkAccess(User $user): bool
    {
        if ((auth()->user()->id === $user->id) || auth()->user()->roles->contains('name', 'manager'))
            return true;
        return false;
    }
}
