<?php

namespace Opmvpc\Patrons\Creational\Tests\Singleton;

use Opmvpc\Patrons\Creational\Singleton\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $this->assertInstanceOf(Singleton::class, Singleton::getInstance());
    }
}
