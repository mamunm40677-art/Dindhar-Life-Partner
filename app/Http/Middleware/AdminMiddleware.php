<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->email === 'admin@dindhar.com') {
            return $next($request);
        }

        if (! $user->isAdmin()) {
            return redirect()->route('home')->with('error', 'আপনার এডমিন প্যানেলে প্রবেশের অনুমতি নেই।');
        }

        return $next($request);
    }
}
