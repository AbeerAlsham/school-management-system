<?php

namespace App\Http\Controllers\Api\Guardians;

use App\Http\Controllers\Controller;
use App\Models\Account\User;
use Illuminate\Http\Request;

class ShowGuardianController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        if (!$this->checkAccess($user))
            return $this->forbiddenResponse('the user have not  role for access to show guardian');

        $user = $user->load('guardian', 'contactNumbers');

        return $this->okResponse($user, 'تم عرض معلومات المستخدم بنجاح ');
    }


    public function checkAccess(User $user): bool
    {
        if ((auth()->user->id === $user->id) || auth()->user->roles->contains('name', 'manager'))
            return true;
        return false;
    }
}
