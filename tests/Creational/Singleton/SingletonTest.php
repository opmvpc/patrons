<?php

namespace Opmvpc\Patrons\Tests\Creational\Singleton;

use BadMethodCallException;
use Opmvpc\Patrons\Creational\Singleton\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $this->assertInstanceOf(Singleton::class, Singleton::getInstance());
    }

    /** @test */
    public function can_not_use_clone()
    {
        $this->expectException(BadMethodCallException::class);
        Singleton::getInstance()->__clone();
    }

    /** @test */
    public function can_not_use_wakeup()
    {
        $this->expectException(BadMethodCallException::class);
        Singleton::getInstance()->__wakeup();
    }
}
