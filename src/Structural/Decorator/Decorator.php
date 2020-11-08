<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Decorator;

abstract class Decorator implements Hamburger
{
    /**
     * @var Hamburger
     */
    protected Hamburger $ref;
}
