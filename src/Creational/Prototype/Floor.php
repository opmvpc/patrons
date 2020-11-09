<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Prototype;

class Floor extends Prototype
{
    public function __construct()
    {
        $this->attributes = [
            'floorId' => 1,
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
    }
}
