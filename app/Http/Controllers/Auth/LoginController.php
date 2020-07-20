<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginRequest $request)
    {
        if (!$token = $this->attemptLogin($request))
            return response()->json(['error' => 'unauthorized'], 401); // unauthorized

        return $this->respondWithToken($token);
    }

    /**
     * Try login with credential
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function attemptLogin($request)
    {
        return Auth::attempt($request->only('username', 'password'));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL()
        ]);
    }
}
