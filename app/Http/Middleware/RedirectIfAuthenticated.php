<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return redirect(RouteServiceProvider::HOME);
                if (auth()->user()->user_role == "administrator") {
                    $notification1 = array(
                        'message' => 'Success, you are logged in as administrator!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('administrator.dashboard')->with($notification1);;
                }elseif (auth()->user()->user_role == "user") {
                    $notification2 = array(
                        'message' => 'Success, you are logged in as user!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('user.dashboard')->with($notification2);;
                }else {
                    Auth::logout();
                    return redirect()->route('login')->with(['error' =>  'Enter your registered and active account']);
                }
            }
        }

        return $next($request);
    }
}
