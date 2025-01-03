<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\User;
use App\Traits\Searchable;

class GetUserController extends Controller
{
    use Searchable;
    /**
     * عرض و بحث من مسنخدمين
     */
    public function __invoke(Request $request)
    {
        $users = User::with('profile', 'roles')
        ->when($request->has('search'), function ($query) use ($request) {
            return $query->whereHas('profile', function ($q) use ($request) {
                return $this->Search($q, $request, ['first_name', 'father_name', 'last_name']);
            });
        })
        ->when($request->has('role_id'), function ($query) use ($request) {
            return $query->whereHas('roles', function ($q) use ($request) {
                $q->where('role_id', $request->role_id);
            });
        })
        ->get(); // Don't forget to call get() to execute the query and retrieve the results.

    return $this->okResponse($users, 'Users retrieved successfully');

    }
}
