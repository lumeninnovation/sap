<?php

namespace Lumen\SAP;

use FunctionCallException;
use Lumen\SAP\Communication\Connection;
use Lumen\SAP\Communication\Server;
use Lumen\SAP\Functions\FunctionModule;
use Lumen\SAP\Illuminate\Orders\SapOrder;

class SAP
{
    protected Connection $connection;

    protected string $on;

    public function __construct($on = null)
    {
        $on = $on ?? config('sap.default');

        $this->connection = new Connection(new Server(array_merge(config('sap.connections.' . $on), [
            'user' => auth()->user()->account,
            'passwd' => auth()->user()->sap->password
        ])));
    }

    public function connection(): Connection
    {
        return $this->connection;
    }

    /**
     * @throws FunctionCallException
     */
    public function fm($name): FunctionModule
    {
        return new FunctionModule($this->connection, $name);
    }
}
