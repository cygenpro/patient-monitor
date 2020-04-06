<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ThrowIfPhoneNumberVerified
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
        if( $request->user()->phone_verified_at )
        {
            throw new NotFoundHttpException();
        }

        return $next($request);
    }
}
