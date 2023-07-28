<?php

namespace DevEngineInstaller\Middleware;

use Closure;
use Redirect;

class canInstall
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (file_exists(storage_path('installed'))) {
            abort(404);
        }
        return $next($request);
    }
}
