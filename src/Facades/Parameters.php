<?php

namespace Lumen\SAP\Facades;

use Illuminate\Support\Facades\Facade;

class Parameters extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Lumen\SAP\Parameters\Parameters::class;
    }
}
