<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AddDeviceTokenRequest;
use App\Models\Accounts\UserDeviceToken;

class AddFCMController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddDeviceTokenRequest $request)
    {
        $token = UserDeviceToken::create([
            'device_token' => $request->device_token,
            'user_id' => $request->user()->id
        ]);

        return $this->okResponse($token, 'the device_token assigned to user successfully');
    }
}
