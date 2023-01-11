<?php

namespace LumenInnovation\SAP\Facades;

use Illuminate\Support\Facades\Facade;

class Parameters extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LumenInnovation\SAP\Parameters\Parameters::class;
    }
}
