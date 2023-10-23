<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRole
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
        // if (in_array(auth()->user()->role, $roles)) {
        //     return $next($request);
        // }

        $userRole = Role::find(auth()->user()->role_id);
        foreach ($roles as $role) {
            // if ($role === "superadmin" && auth()->user()->isSuperadmin()) return $next($request);
            if ($userRole->name === $role) {
                return $next($request);
            }
        }
    }
}
