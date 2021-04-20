<?php

namespace Alighasemzadeh\Gateway\Facades;

use Illuminate\Support\Facades\Facade;
use Alighasemzadeh\Gateway\Contracts\Factory;

/**
 * @see \Alighasemzadeh\Gateway\GatewayManager
 */
class Gateway extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
