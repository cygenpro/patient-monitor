<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckPhoneNumberVerification
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
        if( !$request->user()->phone_verified_at )
        {
            return redirect(route('phone.verify.show'));
        }

        return $next($request);
    }
}
