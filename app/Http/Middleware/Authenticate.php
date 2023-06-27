<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

//PostsControllerに記述のmiddleware('auth')の処理内容が記述されている

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (Auth::check()) {
            return $next($request);
        } else {
            return redirect(route('login'));
        }
    }
}
