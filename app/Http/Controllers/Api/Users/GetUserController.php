<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\User;

class GetUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::with('profile', 'roles')->paginate(10);
        return $this->okResponse($users, 'users retrived successfully');
    }
}
