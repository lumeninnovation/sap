<?php

namespace LumenInnovation\SAP;

use FunctionCallException;
use LumenInnovation\SAP\Communication\Connection;
use LumenInnovation\SAP\Communication\Server;
use LumenInnovation\SAP\Functions\FunctionModule;
use LumenInnovation\SAP\Illuminate\Orders\SapOrder;

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
