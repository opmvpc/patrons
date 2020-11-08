<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Decorator;

class FromageDecorator extends Decorator
{
    const PRICE = 0.60;

    public function __construct(Hamburger $ref)
    {
        $this->ref = $ref;
    }

    public function price(): float
    {
        return static::PRICE + $this->ref->price();
    }

    public function description(): string
    {
        return $this->ref->description() . "\nSupplément fromage fondant";
    }
}
