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
        $user = session()->get('user');
        if ($user)
            if ($user->role == 'admin')
                return $next($request);
            else
                return back()->with('failed','Access Denied!');
        else
            return redirect('login');
    }
}
