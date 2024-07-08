<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Accounts\User;
use App\Http\Requests\Users\AddRoleRequest;

class AddRoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddRoleRequest $request, User $user)
    {
        if ($this->checkRoleAssign($request->role_ids, $user));
        return  $this->unprocessableResponse("the role assignmet already");

        $user->roles()->attach($request->role_ids);
        return $this->createdResponse($user, 'role assigned to user successfully');
    }

    public function checkRoleAssign(array $role_ids, User $user)
    {

        foreach ($role_ids as $role_id) {
            if ($user->roles->contains('id', $role_id))
                // التحقق من كون الدور قد تم تعيينه للمستخدم مسبقاً
                return true;
        }
    }
}
