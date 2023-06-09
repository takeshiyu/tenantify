<?php

namespace TakeshiYu\Tenantify\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use TakeshiYu\Tenantify\Concerns\Tenantable;

class TenantTest extends Model
{
    use Tenantable;

    protected $table = 'tenants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
    ];
}
