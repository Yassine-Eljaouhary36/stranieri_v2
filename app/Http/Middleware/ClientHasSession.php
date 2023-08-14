<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientHasSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(session('client_id'))) {
            return redirect()->route('showLoginForm')->with('custom_alert', ['type' => 'worning', 'title' => 'The life cycle is dead!', 'message' => 'sorry your session is expired.']);
        }
        return $next($request);
    }
}
