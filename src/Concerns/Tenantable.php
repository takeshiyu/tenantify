<?php

namespace Wuhsien\Tenantify\Concerns;

use Illuminate\Support\Facades\Config;

trait Tenantable
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return Config::get('tenantify.tenant_column');
    }
}