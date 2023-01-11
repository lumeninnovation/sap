<?php

namespace LumenInnovation\SAP\Functions;

use Exception;
use FunctionCallException;
use LumenInnovation\SAP\Communication\Connection;
use RuntimeException;

class FunctionModule
{
    use Parameters;

    /**
     * Name of the function module.
     *
     * @var string
     */
    public string $name;

    /**
     * Connection of the function module.
     *
     * @var Connection
     */
    public Connection $connection;


    protected $handle;

    /**
     * Description of the function module.
     *
     * @var \Illuminate\Support\Collection
     */
    protected \Illuminate\Support\Collection $description;

    /**
     * Create a new instance of the object.
     *
     * @param Connection $connection
     * @param string $name
     * @return void
     * @throws FunctionCallException
     */
    public function __construct(Connection $connection, string $name)
    {
        $this->connection = $connection;
        $this->name = $name;
        $this->initialize();
    }

    public function invoke()
    {
        return array_trim($this->handle->invoke($this->getParameters()));
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Initialize the function module.
     *
     * @return void
     * @throws FunctionCallException
     */
    private function initialize()
    {
//        $this->safe(function () {

            $this->handle = $this->connection
                ->getHandle()
                ->getFunction($this->name);

            // Save the description.
            $this->description = collect(
                json_decode(
                    json_encode($this->handle->getFunctionDescription()),
                    true
                )
            );

//        });
    }

    /**
     * Wrap a callable with mixed version exception handle.
     *
     * @param callable $callback
     *
     * @return mixed
     * @throws FunctionCallException
     */
    private function safe(callable $callback): mixed
    {
        try {
            return $callback();
        }
        catch (Exception|RuntimeException $e) {
            throw new FunctionCallException($e);
        }
    }
}
