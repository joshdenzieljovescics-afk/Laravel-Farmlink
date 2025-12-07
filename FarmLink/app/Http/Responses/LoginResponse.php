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
        // Check if user is admin, redirect to admin dashboard, otherwise redirect to home
        if (auth()->user() && auth()->user()->is_admin) {
            return $request->wantsJson()
                ? new JsonResponse([], 200)
                : redirect()->intended(route('admin.dashboard'));
        }

        return $request->wantsJson()
            ? new JsonResponse([], 200)
            : redirect()->intended(route('home'));
    }
}