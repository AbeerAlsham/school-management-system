<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Role;
use Illuminate\Http\Request;

class IndexRoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->okResponse(Role::get(), 'the roles retrieved successfully');
    }
}
