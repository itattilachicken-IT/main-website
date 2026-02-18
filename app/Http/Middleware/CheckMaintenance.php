<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaintenance
{
    public function handle(Request $request, Closure $next)
    {
        $flagPath = storage_path('framework/maintenance.flag');

        // Skip admin routes
        if ($request->is('admin/*')) {
            return $next($request);
        }

        // If maintenance mode is active, show maintenance view
        if (file_exists($flagPath)) {
            return response()->view('maintenance')->setStatusCode(503);
        }

        return $next($request);
    }
}
