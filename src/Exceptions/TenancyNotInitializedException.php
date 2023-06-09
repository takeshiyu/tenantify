<?php

namespace TakeshiYu\Tenantify\Exceptions;

use Exception;

class TenancyNotInitializedException extends Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message ?: 'Tenancy is not initialized.');
    }
}
