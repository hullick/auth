<?php

namespace Mkoders\Auth\Facades;

use Illuminate\Support\Facades\Facade;

class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'auth';
    }
}
