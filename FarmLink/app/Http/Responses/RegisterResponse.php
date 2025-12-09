<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
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

        // Redirect based on user type after registration
        if ($user->user_type === 'seller') {
            return $request->wantsJson()
                ? new JsonResponse([], 201)
                : redirect()->route('seller.dashboard')->with('success', 'Welcome to FarmLink! Start adding your products.');
        }

        // Buyer - redirect to dashboard
        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->route('dashboard')->with('success', 'Welcome to FarmLink! Start exploring fresh produce.');
    }
}
