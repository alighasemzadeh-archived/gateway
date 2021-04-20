<?php

namespace Alighasemzadeh\Gateway\Contracts;

interface Factory
{
    /**
     * Get an Gateway provider implementation.
     *
     * @param  string $driver
     * @return \Alighasemzadeh\Gateway\Contracts\Provider
     */
    public function driver($driver = null);
}
