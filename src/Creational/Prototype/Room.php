<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Prototype;

class Room extends Prototype
{
    public function __construct()
    {
        $this->attributes = [
            'roomId' => 1,
            'walls' => [],
        ];
    }

    public function draw(): void
    {
    }

    public function addWall(Wall $wall): void
    {
        $this->attributes['walls'][] = $wall;
    }

    public function __clone()
    {
        parent::__clone();
    }
}
