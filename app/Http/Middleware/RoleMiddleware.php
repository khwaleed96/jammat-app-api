<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $allowedUserRoles = array(...$roles);
        $authUserRole = auth()->user()->user_role_id;

        if (!in_array($authUserRole, $allowedUserRoles)) {
            return response()->json([
                'error' => 'Unauthorized',
                'success' => false,
            ], 401);
        }



        return $next($request);
    }
}
