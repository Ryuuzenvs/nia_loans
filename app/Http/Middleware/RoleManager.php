<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\authController;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next

get roole param,
if auth cek , auth usr role != role
abrt 403
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
{
    // log stats chek
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    // is role array $roles
    // in_array cek"
    if (in_array($user->role, $roles)) {
        return $next($request);
    }

    // Jika tidak sesuai
    abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
