<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Decorator;

class BurgerDoubleViande implements Hamburger
{
    const PRICE = 4.99;

    public function price(): float
    {
        return static::PRICE;
    }

    public function description(): string
    {
        return 'Hamburger with 2 steacks, some salad and tomato, special sauce';
    }
}
