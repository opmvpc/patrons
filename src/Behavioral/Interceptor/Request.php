<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Behavioral\Interceptor;

class Request
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function data(): array
    {
        return $this->data;
    }
}
