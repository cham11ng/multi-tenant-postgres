<?php

namespace App\Http\Middleware;

use App\Http\Facades\PGSchema;
use App\Tenant;
use Closure;

class SwitchSchema
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $subDomain = explode('.', $request->getHttpHost())[0];
        Tenant::where('sub_domain', $subDomain)->firstOrFail();
        PGSchema::switchTo($subDomain); // if sub-domain exists, change the schema to the tenant schema

        return $next($request);
    }
}
