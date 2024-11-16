<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user->is_verified) {
            return redirect()->route('admin.view_change_password');
        }

        if ($user && in_array($user->role, $roles)) {
            if ($user->role == 'admin') {
                $route = $request->route();
                if (Route::is('admin.club.*') && $route->parameter('id') != $user->club_id) {
                    return redirect()->route('admin.club.details', ['id' => $user->club_id]);
                }
            }
            return $next($request);
        }

        if ($user->role == 'admin') {
            return redirect()->route('admin.club.details', ['id' => $user->club_id]);
        }

        return redirect()->route('admin.unauthorized')->with('error', 'You are not authorized to access this page.');
    }
}
