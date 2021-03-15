<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LivewireAuthenticate extends Authenticate
{

    public function handle($request, \Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }


    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        $controller = $request->route()->getController();
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard) && method_exists($controller,);
            }
        }

        $this->unauthenticated($request, $guards);
    }
}
