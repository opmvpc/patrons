<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Prototype;

class Room extends Prototype
{
    public static int $roomsCount = 0;

    public function __construct()
    {
        $this->attributes = [
            'roomId' => ++static::$roomsCount,
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
        $this->attributes['roomId'] = ++static::$roomsCount;
    }
}
