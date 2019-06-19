<?php

namespace DeskFlix\Http\Middleware;

use Closure;
use DeskFlix\Exceptions\SubscriptionInvalidException;

class CheckSubscriptions
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
        $user = $request->user('api');
        $valid = $user->hasSubscriptionValid();
        if(!$valid){
            throw new SubscriptionInvalidException("User is not a valid subscription");
        }

        return $next($request);
    }
}
