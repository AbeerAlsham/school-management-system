<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateProfileRequest;
use App\Models\Account\Profile;
use Illuminate\Support\Facades\Auth;

class UpdateProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProfileRequest $request, Profile $profile)
    {
        $profile->update($request->all());
        return $this->okResponse($profile, 'profile updated successfully');
    }
}
