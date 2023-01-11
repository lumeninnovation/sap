<?php

namespace Lumen\SAP\Functions;

trait Parameters
{
    protected array $parameters = [];

    public function addParameter($key, $value): static
    {
        key_exists($key, $this->parameters) ? null : $this->parameters[$key] = [];

        if(is_array($value))
            $this->parameters[$key] = array_merge($this->parameters[$key], $value);
        else
            $this->parameters[$key] = $value;

        return $this;
    }

    public function addParameterArray(array $parameters): static
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
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
        return $this->parameters;
    }
}
