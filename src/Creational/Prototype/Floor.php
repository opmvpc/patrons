<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Prototype;

class Floor extends Prototype
{
    public static int $floorsCount = 0;

    public function __construct()
    {
        $this->attributes = [
            'floorId' => ++static::$floorsCount,
            'rooms' => [],
        ];
    }

    public function draw(): void
    {
    }

    public function addRoom(Room $room): void
    {
        $this->attributes['rooms'][] = $room;
    }

    public function __clone()
    {
        parent::__clone();
        $this->attributes['floorId'] = ++static::$floorsCount;
    }
}
