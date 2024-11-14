<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('AdminAuth middleware triggered');

        if (!Auth::guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/Adminlogin')->with('error', 'You must be logged in to access this page.');
        }
        return $next($request);
    }


}
