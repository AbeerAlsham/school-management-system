<?php

namespace App\Http\Controllers\Api\Guardians;

use App\Http\Controllers\Controller;
use App\Models\Accounts\ContactNumber;
use App\Models\Accounts\Guardian;
use Illuminate\Http\Request;

class EditGuardianController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //تعديل معلومات ولي امر معين
    public function __invoke(Request $request,Guardian $guardian)
    {
        $guardian->update($request->guardian);

        $phone_numbers = array_map(function ($phone_number) {
            return new ContactNumber($phone_number);
        }, $request->phone_numbers);
        
        $guardian->user()->contactNumbers()->saveMany($phone_numbers);

        return $this->createdResponse($guardian,'تم تعديل معلومات ولي الأمر بنجاح ');
    }
}
