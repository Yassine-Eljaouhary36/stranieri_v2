<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
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
        $client=Auth::guard('client')->user();
        if (!$client->is_email_verified) {
            Auth::guard('client')->logout();
            return redirect()->route('verification.notice')->
                with('custom_alert', ['type' => 'warning', 'title' => 'You need to confirm your account.', 'message' => ' We have sent you an activation link, please check your email.']);
          }
        return $next($request);
    }
}
