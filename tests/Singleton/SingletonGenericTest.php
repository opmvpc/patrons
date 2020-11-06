<?php

namespace Opmvpc\Patrons\Tests\Singleton;

use Opmvpc\Patrons\Singleton\SingletonGeneric;
use PHPUnit\Framework\TestCase;

class SingletonGenericTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $this->assertInstanceOf(SingletonGeneric::class, SingletonGeneric::getInstance());
    }
}
