<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
        if (! $request->expectsJson()) {
            // 管理者用URLなら管理者ログインへ、それ以外なら一般ログインへ
            if ($request->is('admin/*')) {
                return route('admin.show.login');
            }
            return route('admin.show.login');
        }
    }
}
