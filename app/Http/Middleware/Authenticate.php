<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Kembalikan null agar tidak redirect ke route('login') yang tidak ada
            abort(response()->json([
                'success' => false,
                'message' => 'Unauthenticated.'
            ], 401));
        }

        return null; // Jika request expects JSON, tetap kembalikan null (tidak redirect)
    }
}
