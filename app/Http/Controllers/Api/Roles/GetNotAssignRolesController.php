<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use App\Models\Account\Role;
use App\Models\Account\User;
use Illuminate\Http\Request;

class GetNotAssignRolesController extends Controller
{
    /**
     * أرجاع الأدوار التي لم تتعين على مستخدم باستثناء ولي الامر لعرضهم عند تعيين دور آخر على مستخدم معين
     */
    public function __invoke(Request $request, User $user)
    {
        $availableRoles = Role::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->whereNot('name', 'ولي أمر')->get();

        return $this->okResponse($availableRoles, 'the role not assign retrieved successfully');
    }
}
