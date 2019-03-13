<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if( strpos($request->route()->getPrefix(),'api') >=0){
            header('application/json');
            exit (json_encode([
                'success'   => false,
                'data'      => '401 Unauthorized Access'
            ]));
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
