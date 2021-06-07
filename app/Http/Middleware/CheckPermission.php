<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('userInfo') ) {
            $userInfo = $request->session()->get('userInfo');
            if($userInfo['level'] == 'admin'){
                return $next($request);
            }
            return redirect()->route('notify/noPermission');
        }

        return $next($request);
    }
}