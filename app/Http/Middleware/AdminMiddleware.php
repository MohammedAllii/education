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
    public function handle($request, Closure $next)
{
    if (auth()->user() && auth()->user()->isAdmin()) {
        return $next($request);
    }

    return redirect('/dashboard')->with('error', "Vous n'avez pas l'autorisation d'accéder à cette page.");
}

}
