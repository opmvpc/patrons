<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Decorator;

interface Hamburger
{
    public function price(): float;

    public function description(): string;
}
