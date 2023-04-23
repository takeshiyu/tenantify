<?php

namespace TakeshiYu\Tenantify\Exceptions;

use Exception;

class TenantNotFoundException extends Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message ?: 'Tenant is not found.');
    }
}
