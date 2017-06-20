<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Tenant
 * @package App
 */
class Tenant extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'schema',
        'sub_domain',
        'email'
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        $schema = config('database.connections.' . config('database.default') . '.schema') . '.';
        if (!isset($this->table)) {
            return $schema . str_replace('\\', '', Str::snake(Str::plural(class_basename($this))));
        }

        return $schema . $this->table;
    }

    /**
     * Set the tenant's sub-domain.
     *
     * @param  string $value
     * @return void
     */
    public function setSubDomainAttribute($value)
    {
        $this->attributes['sub_domain'] = strtolower($value);
    }

    /**
     * Set the tenant's schema.
     *
     * @param  string $value
     * @return void
     */
    public function setSchemaAttribute($value)
    {
        $this->attributes['schema'] = strtolower(str_replace('-', '_', $value));
    }
}
