<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Role
 * @package App
 */
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name'
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
     * Users relationship to fetch users of corresponding role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
