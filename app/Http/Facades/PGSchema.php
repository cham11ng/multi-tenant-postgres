<?php

namespace App\Http\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Schemas
 * @package App\Http\Facades
 */
class PGSchema extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pgschema';
    }
}
