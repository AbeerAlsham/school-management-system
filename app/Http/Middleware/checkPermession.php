<?php

namespace App\Http\Middleware;

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
        $roles = $user->roles;
        $permissionName = Route::currentRouteName();
        foreach ($roles as $role) {
            if ($role->hasPermession($permissionName)) {
                return $next($request);
            }
        }
        return $this->forbiddenResponse('You are not authorized to apply this action');
    }
}
