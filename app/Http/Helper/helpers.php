<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('tenant_route')) {
    function tenant_route($route)
    {
        return route($route, ['tenant' => Request::route()->parameter('tenant')]);
    }
}