<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateProfileRequest;
use App\Models\Accounts\Profile;
use Illuminate\Support\Facades\Auth;

class UpdateProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProfileRequest $request, Profile $profile)
    {
        dd('mmmm');
        if (Auth::user()->id !== $profile->user_id) {
            return $this->forbiddenResponse('You are not authorized to apply this action');
        }

        $profile->update($request->all);
        return $this->okResponse($profile, 'profile updated successfully');
    }
}
