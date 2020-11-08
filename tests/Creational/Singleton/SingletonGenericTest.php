<?php

namespace Opmvpc\Patrons\Creational\Tests\Singleton;

use BadMethodCallException;
use Error;
use Opmvpc\Patrons\Creational\Singleton\AnotherSingleton;
use Opmvpc\Patrons\Creational\Singleton\MySingleton;
use PHPUnit\Framework\TestCase;

class SingletonGenericTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $this->assertInstanceOf(MySingleton::class, MySingleton::getInstance());
    }

    /** @test */
    public function can_return_multiple_instances()
    {
        $this->assertInstanceOf(MySingleton::class, MySingleton::getInstance());
        $this->assertInstanceOf(AnotherSingleton::class, AnotherSingleton::getInstance());
        $this->assertSame(MySingleton::getInstance(), MySingleton::getInstance());
        $this->assertSame(AnotherSingleton::getInstance(), AnotherSingleton::getInstance());
    }

    /** @test */
    public function singletons_different_hello_method()
    {
        $this->assertEquals('hello!', MySingleton::getInstance()->hello());
        $this->assertEquals('coucou!', AnotherSingleton::getInstance()->hello());
    }

    /** @test */
    public function can_not_instanciate_itself()
    {
        $this->expectException(Error::class);
        $this->assertEquals(MySingleton::getInstance(), new MySingleton());
    }

    /** @test */
    public function can_not_use_clone()
    {
        $this->expectException(BadMethodCallException::class);
        MySingleton::getInstance()->__clone();
    }

    /** @test */
    public function can_not_use_wakeup()
    {
        $this->expectException(BadMethodCallException::class);
        MySingleton::getInstance()->__wakeup();
    }
}
