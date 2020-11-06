<?php

namespace Opmvpc\Patrons\Tests\Singleton;

use Opmvpc\Patrons\Singleton\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $this->assertInstanceOf(Singleton::class, Singleton::getInstance());
    }
}
