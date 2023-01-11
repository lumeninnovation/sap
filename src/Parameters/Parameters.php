<?php
namespace Lumen\SAP\Parameters;

class Parameters
{
    protected array $parameters = [
        'IT_METHODS' => []
    ];

    protected int $ref = 1;

    public int $operationReferenceNumber = 1;

    public function addParameter($key, $value): static
    {
        $this->parameters[$key][] = $value;

        return $this;
    }

    public function addParameterArray(array $parameters): static
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
    }

    public function addParameterTo($header, array $array, $keyBy = 0)
    {
        if(array_key_exists($header, $this->parameters)) {
            foreach ($array as $key => $value) {
                $this->parameters[$header][$keyBy][$key] = $value;
            }
        } else {
            $this->parameters[$header][$keyBy] = $array;
        }
    }

    public function setParameter($parameter, $key, $value, $up = true): static
    {
        $this->parameters[$parameter][0][$key] = $value;

        if($up)
            $this->parameters[$parameter . '_UP'][0][$key] = 'X';

        return $this;
    }

    public function getParameters()
    {
        foreach($this->parameters as $key => $value)
        {
            if(is_array($value))
                $this->parameters[$key] = array_values($value);
        }

        return $this->parameters;
    }

    public function getNextReferenceNumber(): string
    {
        $this->ref++;

        return (string) $this->ref;
    }

    public function getReferenceNumber(): string
    {
        return (string) $this->ref;
    }

    public function getNextOperationReferenceNumber(): string
    {
        $this->operationReferenceNumber++;

        return (string) $this->operationReferenceNumber;
    }

    public function getOperationReferenceNumber(): string
    {
        return (string) $this->operationReferenceNumber;
    }

    public function advanceReferenceNumber(): void
    {
        $this->ref++;
    }

    public function get($key)
    {
        return $this->parameters[$key];
    }

    public function show()
    {
        return $this;
    }
}
