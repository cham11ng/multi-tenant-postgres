<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'schema',
        'sub_domain',
        'email'
    ];

    protected $table = 'public.tenants';

    /**
     * Set the tenant's sub-domain.
     *
     * @param  string $value
     * @return void
     */
    public function setSubDomainAttribute($value)
    {
        $this->attributes['sub_domain'] = kebab_case(ucwords($value));
    }

    /**
     * Set the tenant's schema.
     *
     * @param  string $value
     * @return void
     */
    public function setSchemaAttribute($value)
    {
        $this->attributes['schema'] = snake_case(ucwords($value));
    }
}
