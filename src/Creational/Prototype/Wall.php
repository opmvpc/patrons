<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Prototype;

class Wall extends Prototype
{
    public function __construct()
    {
        $this->attributes = [
            'height' => 0,
            'width' => 0,
        ];
    }

    public function draw(): void
    {
    }
}
