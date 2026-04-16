<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * Tambahkan case 'kesiswaan' supaya middleware guest:kesiswaan
     * redirect ke dashboard kesiswaan, bukan ke HOME default.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Kalau guard kesiswaan sudah login → redirect ke dashboard kesiswaan
                if ($guard === 'kesiswaan') {
                    return redirect()->route('kesiswaan.dashboard');
                }

                // Guard lain → redirect ke HOME default
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}