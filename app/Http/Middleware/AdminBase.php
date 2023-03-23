<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminBase
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()['role'] == 0) {
            return $next($request);
        }

        return response()->json(['error' => 'НЕдостаточно прав'], 401);
    }
}
