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
        $user=\App\Models\User::where('id','=',session()->get('user_id'))->first();
        if (!$user->is_email_verified) {
            notify('You need to confirm your account. We have sent you an activation link, please check your email.','','topRight');
            return route('user.logout');
          }
        return $next($request);
    }
}
