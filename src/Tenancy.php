<?php

namespace TakeshiYu\Tenantify;

use Illuminate\Support\Facades\Facade;

class Tenancy extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TenancyManager::class;
    }
}
