<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Accounts\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->unprocessableResponse('password or username not correct');
        }
        $token = $user->createToken('schoolSixth')->plainTextToken;

        $user->deviceTokens()->firstOrCreate([
            'device_token' => $request->device_token,
        ]);
        return $this->okResponse([
            'user' => $user->load('roles'),
            'token' => $token
        ], " user login successfully");
    }
}
