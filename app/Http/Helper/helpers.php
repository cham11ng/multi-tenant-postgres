<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('tenant_route')) {
    /**
     * Tenant route is for Dynamic sub-domain routing
     *
     * @param       $route
     * @param array $parameters
     * @param bool  $absolute
     * @return string
     */
    function tenant_route($route, $parameters = [], $absolute = true)
    {
        $tenant_parameter = ['tenant' => Request::route()->parameter('tenant')];
        $parameters = $parameters ? array_merge($tenant_parameter, $parameters) : $tenant_parameter;
        return route($route, $parameters, $absolute);
    }
}
