<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // If user is admin, redirect to home page
                if ($user->is_admin) {
                    return redirect()->route('home');
                }

                // If user is a seller (farmer), redirect to seller dashboard
                if ($user->user_type === 'seller') {
                    return redirect()->route('seller.dashboard');
                }

                // If user is a buyer, redirect to home page
                if ($user->user_type === 'buyer') {
                    return redirect()->route('home');
                }

                // Default fallback to home
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
