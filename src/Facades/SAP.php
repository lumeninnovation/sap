<?php

namespace Lumen\SAP\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lumen\SAP\SAP
 */
class SAP extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Lumen\SAP\SAP::class;
    }
}
