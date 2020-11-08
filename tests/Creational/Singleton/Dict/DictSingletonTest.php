<?php

namespace Opmvpc\Patrons\Creational\Tests\Singleton;

use Error;
use Opmvpc\Patrons\Creational\Singleton\Dict\DictEnglishSingleton;
use Opmvpc\Patrons\Creational\Singleton\Dict\DictFrenchSingleton;
use PHPUnit\Framework\TestCase;

class DictSingletonTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $this->assertInstanceOf(DictEnglishSingleton::class, DictEnglishSingleton::getInstance());
    }

    /** @test */
    public function can_return_multiple_instances()
    {
        $this->assertInstanceOf(DictEnglishSingleton::class, DictEnglishSingleton::getInstance());
        $this->assertInstanceOf(DictFrenchSingleton::class, DictFrenchSingleton::getInstance());
        $this->assertSame(DictEnglishSingleton::getInstance(), DictEnglishSingleton::getInstance());
        $this->assertSame(DictFrenchSingleton::getInstance(), DictFrenchSingleton::getInstance());
    }

    /** @test */
    public function singletons_get_translations()
    {
        $this->assertEquals('Hi!', DictEnglishSingleton::getInstance()->get('salutation'));
        $this->assertEquals('Bonjour!', DictFrenchSingleton::getInstance()->get('salutation'));
    }

    /** @test */
    public function singletons_get_lang()
    {
        $this->assertEquals('en', DictEnglishSingleton::getInstance()->getLang());
        $this->assertEquals('fr', DictFrenchSingleton::getInstance()->getLang());
    }

    /** @test */
    public function can_not_instanciate_itself()
    {
        $this->expectException(Error::class);
        $this->assertEquals(DictEnglishSingleton::getInstance(), new DictEnglishSingleton());
    }
}
