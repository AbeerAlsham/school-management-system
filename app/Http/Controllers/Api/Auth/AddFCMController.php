<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddFCMController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return $this->okResponse('the fcm_token assigned to user successfully');
    }
}
