<?php

namespace LumenInnovation\SAP\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \LumenInnovation\SAP\Illuminate\Orders\SapWorkOrder find(string $order)
 */

class SapWorkOrder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LumenInnovation\SAP\Illuminate\Orders\SapWorkOrder::class;
    }
}
