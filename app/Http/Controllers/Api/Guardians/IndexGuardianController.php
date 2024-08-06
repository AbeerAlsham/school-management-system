<?php

namespace App\Http\Controllers\Api\Guardians;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\User;

class IndexGuardianController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //عرض أولياء الأمور مع الطلاب المسؤولين عنهم
    public function __invoke(Request $request)
    {
        $guardians = User::with(['guardian', 'contactNumbers'])
            ->whereHas('roles', function ($query) {
                $query->where('name', 'guardian');
            })
            ->get();
        return $this->okResponse($guardians, 'تم الاستعلام عن أولياء الأمور بنجاح ');
    }
}
