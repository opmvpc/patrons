<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Composite;

abstract class Component
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function children(): array;

    public function name()
    {
        return $this->name;
    }
}
