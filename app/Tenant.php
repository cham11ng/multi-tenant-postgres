<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'sub_domain',
        'email'
    ];

    protected $table = 'public.tenants';
}
