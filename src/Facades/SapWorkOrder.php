<?php

namespace Lumen\SAP\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Lumen\SAP\Illuminate\Orders\SapWorkOrder find(string $order)
 */

class SapWorkOrder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Lumen\SAP\Illuminate\Orders\SapWorkOrder::class;
    }
}
