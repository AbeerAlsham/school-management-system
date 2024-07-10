<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Models\Accounts\User;
use Illuminate\Support\Facades\Hash;

class CreateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateUserRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request['password']),
        ]);
        $user->profile()->create($request->profile);
        $user->roles()->attach($request->role_ids);

        return $this->createdResponse(['user'=>$user,'profile'=>$user->profile,'roles'=>$user->roles ],'user added successfully');
    }
}
