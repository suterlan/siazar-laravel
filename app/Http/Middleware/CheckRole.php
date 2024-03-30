<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Providers\RouteServiceProvider;
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
        if (in_array(auth()->user()->role->name, $roles)) {
            return $next($request);
        }

        if(auth()->user()->role->name === 'siswa'){
            return redirect(RouteServiceProvider::HOME_SISWA);
        }else{
            return redirect(RouteServiceProvider::HOME);
        }

        // $userRole = Role::find(auth()->user()->role_id);
        // foreach ($roles as $role) {
        //     // if ($role === "superadmin" && auth()->user()->isSuperadmin()) return $next($request);
        //     if ($userRole->name === $role) {
        //         return $next($request);
        //     }
        //     else{
        //         abort(403);
        //     }
        // }
    }
}
