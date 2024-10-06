<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Models\Accounts\ContactNumber;
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

        $phone_numbers = array_map(function ($phone_number) {
            return new ContactNumber($phone_number);
        }, $request->phone_numbers);+-
        $user->contactNumbers()->saveMany($phone_numbers);

        $user->roles()->attach($request->role_ids);

        return $this->createdResponse(['user' => $user, 'profile' => $user->profile, 'roles' => $user->roles], 'user added successfully');
    }
}
