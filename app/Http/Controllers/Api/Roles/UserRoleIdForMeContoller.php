<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Role;
use App\Models\Accounts\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleIdForMeContoller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Role $role, User $user)
    {
        if ($user->id === auth('sanctum')->id()) {
            $userRole = UserRole::where('role_id', $role->id)->where('user_id', auth('sanctum')->id())->first();
            return $this->okResponse($userRole, 'the user role retrived successfully');
        } else {
            return $this->forbiddenResponse();
        }
    }
}
