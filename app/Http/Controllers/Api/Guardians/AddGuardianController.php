<?php

namespace App\Http\Controllers\Api\Guardians;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guardians\AddGuardianRequest;
use App\Models\Accounts\ContactNumber;
use App\Models\Accounts\User;
use Illuminate\Support\Facades\Hash;

class AddGuardianController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddGuardianRequest $request)
    {

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request['password']),
        ]);

        $user->roles()->attach(5);

        $user->guardian()->create($request->guardian);

        $phone_numbers = array_map(function ($phone_number) {
            return new ContactNumber($phone_number);
        }, $request->phone_numbers);
        $user->contactNumbers()->saveMany($phone_numbers);

        return $this->createdResponse($user, 'تمت إضافة ولي الأمر بنجاح ');
    }
}
