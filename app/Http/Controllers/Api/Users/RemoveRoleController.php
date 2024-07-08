<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\User;
use App\Models\Accounts\Role;

class removeRoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,User $user,Role $role)
    {
        $user->roles()->detach($role->id);
        return $this->noContentResponse();
    }
}
