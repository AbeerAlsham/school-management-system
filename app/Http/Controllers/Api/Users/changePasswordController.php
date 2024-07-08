<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Accounts\User;
use App\Http\Requests\Auth\ChangePasswordRequest;

class changePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangePasswordRequest $request,User $user)
    {
        if (!Hash::check($request->old_password, $user->password)) {
            return $this->unprocessableResponse('Old password is incorrect');
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return $this->okResponse('Password updated successfully');
    }
}
