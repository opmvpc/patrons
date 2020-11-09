<?php

namespace Opmvpc\Patrons\Tests\Creational\Prototype;

use Opmvpc\Patrons\Creational\Prototype\Floor;
use Opmvpc\Patrons\Creational\Prototype\Room;
use Opmvpc\Patrons\Creational\Prototype\Wall;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $floor = new Floor();
        $this->assertInstanceOf(Floor::class, $floor);
        $this->assertEquals(1, $floor['floorId']);
    }

    /** @test */
    public function can_use_clone()
    {
        $floor = new Floor();
        $secondFloor = clone $floor;
        $this->assertInstanceOf(Floor::class, $secondFloor);
        $this->assertEquals(2, $floor['floorId']);
        $this->assertEquals(3, $secondFloor['floorId']);
    }

    /** @test */
    public function floor_can_draw()
    {
        $floor = new Floor();
        $this->assertNull($floor->draw());
    }

    /** @test */
    public function can_add_rooms_and_copy()
    {
        $floor = new Floor();
        $room = new Room();
        $room2 = clone $room;
        $floor->addRoom($room);
        $floor->addRoom($room2);

        $this->assertEquals(1, $room['roomId']);
        $this->assertEquals(2, $room2['roomId']);
        $this->assertEquals(1, $floor['rooms'][0]['roomId']);
        $this->assertEquals(2, $floor['rooms'][1]['roomId']);

        $floorCopy = clone $floor;
        $this->assertEquals(5, $floor['floorId']);
        $this->assertEquals(6, $floorCopy['floorId']);
        $this->assertEquals(3, $floorCopy['rooms'][0]['roomId']);
        $this->assertEquals(4, $floorCopy['rooms'][1]['roomId']);
    }

    /** @test */
    public function can_add_walls_and_copy()
    {
        $floor = new Floor();
        $room = new Room();
        $floor->addRoom($room);

        $wall = new Wall();
        $wall['width'] = 2;
        $wall['height'] = 2;
        $wall2 = clone $wall;
        $wall2['width'] = 3;
        $wall3 = clone $wall;
        $wall4 = clone $wall2;

        $room->addWall($wall);
        $room->addWall($wall2);
        $room->addWall($wall3);
        $room->addWall($wall4);

        $this->assertEquals(2, $floor['rooms'][0]['walls'][0]['height']);
        $this->assertEquals(2, $floor['rooms'][0]['walls'][0]['width']);
        $this->assertEquals(2, $floor['rooms'][0]['walls'][1]['height']);
        $this->assertEquals(3, $floor['rooms'][0]['walls'][1]['width']);
        $this->assertEquals(2, $floor['rooms'][0]['walls'][2]['height']);
        $this->assertEquals(2, $floor['rooms'][0]['walls'][2]['width']);
        $this->assertEquals(2, $floor['rooms'][0]['walls'][3]['height']);
        $this->assertEquals(3, $floor['rooms'][0]['walls'][3]['width']);

        $roomCopy = clone $room;
        $floor->addRoom($roomCopy);
        $this->assertEquals(2, $floor['rooms'][1]['walls'][0]['height']);
        $this->assertEquals(2, $floor['rooms'][1]['walls'][0]['width']);
        $this->assertEquals(2, $floor['rooms'][1]['walls'][1]['height']);
        $this->assertEquals(3, $floor['rooms'][1]['walls'][1]['width']);
        $this->assertEquals(2, $floor['rooms'][1]['walls'][2]['height']);
        $this->assertEquals(2, $floor['rooms'][1]['walls'][2]['width']);
        $this->assertEquals(2, $floor['rooms'][1]['walls'][3]['height']);
        $this->assertEquals(3, $floor['rooms'][1]['walls'][3]['width']);
    }

    /** @test */
    public function array_offset_exists()
    {
        $floor = new Floor();
        $this->assertTrue($floor->offsetExists('floorId'));
    }

    /** @test */
    public function array_offset_set()
    {
        $floor = new Floor();
        $floor['floorId'] = 10;
        $this->assertEquals(10, $floor['floorId']);
        $floor[] = 10;
        $this->assertEquals(10, $floor[0]);
    }

    /** @test */
    public function array_unset()
    {
        $floor = new Floor();
        $this->assertTrue($floor->offsetExists('floorId'));
        $floor->offsetUnset('floorId');
        $this->assertFalse($floor->offsetExists('floorId'));
    }

    /** @test */
    public function room_can_draw()
    {
        $room = new Room();
        $this->assertNull($room->draw());
    }

    /** @test */
    public function wall_can_draw()
    {
        $wall = new Wall();
        $this->assertNull($wall->draw());
    }
}
