<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\JsonResponse;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if user is admin, redirect to admin dashboard
        if ($user->is_admin) {
            return $request->wantsJson()
                ? new JsonResponse([], 200)
                : redirect()->intended(route('admin.dashboard'));
        }

        // Check if user is a seller (farmer), redirect to seller dashboard
        if ($user->user_type === 'seller') {
            return $request->wantsJson()
                ? new JsonResponse([], 200)
                : redirect()->intended(route('seller.dashboard'));
        }

        // Otherwise, buyer - redirect to home/dashboard
        return $request->wantsJson()
            ? new JsonResponse([], 200)
            : redirect()->intended(route('dashboard'));
    }
}