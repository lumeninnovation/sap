<?php

namespace LumenInnovation\SAP\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LumenInnovation\SAP\SAP
 */
class SAP extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LumenInnovation\SAP\SAP::class;
    }
}
