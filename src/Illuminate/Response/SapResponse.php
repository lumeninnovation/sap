<?php

namespace Lumen\SAP\Illuminate\Response;

class SapResponse
{
    public function __construct(
        protected array $update,
        protected array $commit) {}

    public function wasSuccessful(): bool
    {
        return collect($this->update['RETURN'])->where('TYPE', 'S')->count() > 0;
    }

    public function getRawUpdate(): array
    {
        return $this->update;
    }
}
