<?php

namespace App\Http\Middleware;

use App\Models\AcademicYear\Semester;
use App\Models\Account\UserRole;
use Closure;
use Illuminate\Http\Request;
use App\Traits\ApiResponder;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class checkPermession
{
    use ApiResponder;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();
        $semesters = Semester::availableSemester();
        $roles = $user->roles;
        $permissionName = Route::currentRouteName();

        foreach ($roles as $role) {
            if ($role->hasPermession($permissionName)) {

                $is_available = UserRole::find($role->pivot->id)->whereHas('semesters', function ($query) use ($semesters) {
                    $query->whereIn('semesters.id', $semesters);
                })->exists(); // تحقق مما إذا كانت هناك نتائج

                if ($is_available)
                    return $next($request);
            }
        }
        return $this->forbiddenResponse('You are not authorized to apply this action');
    }
}
