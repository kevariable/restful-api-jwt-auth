<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        auth()->logout();

        if (auth()->check() === false)
            return response()->json([
                'status' => 'logout'
            ]);
    }
}
