<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TakeshiYu\Tenantify\Concerns\Tenantable;

class Tenant extends Model
{
    use HasFactory, Tenantable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenants';
}
