<?php

namespace Opmvpc\Patrons\Tests\Structural\Decorator;

use Opmvpc\Patrons\Structural\Decorator\BaconDecorator;
use Opmvpc\Patrons\Structural\Decorator\BurgerDoubleViande;
use Opmvpc\Patrons\Structural\Decorator\FromageDecorator;
use PHPUnit\Framework\TestCase;

class ProxyTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $burger = new BurgerDoubleViande();
        $this->assertInstanceOf(BurgerDoubleViande::class, $burger);
    }

    /** @test */
    public function get_burger_price()
    {
        $burger = new BurgerDoubleViande();
        $this->assertEquals(4.99, $burger->price());
    }

    /** @test */
    public function get_burger_with_bacon_price()
    {
        $burger = new BurgerDoubleViande();
        $burgerBacon = new BaconDecorator($burger);
        $this->assertEquals((4.99 + 0.80), $burgerBacon->price());
    }

    /** @test */
    public function get_burger_with_bacon_and_cheese_price()
    {
        $burger = new BurgerDoubleViande();
        $burgerBacon = new BaconDecorator($burger);
        $burgerBaconCheese = new FromageDecorator($burgerBacon);
        $this->assertEquals((4.99 + 0.80 + 0.60), $burgerBaconCheese->price());
    }

    /** @test */
    public function get_burger_description()
    {
        $burger = new BurgerDoubleViande();
        $this->assertStringContainsString('Hamburger with 2 steacks, some salad and tomato, special sauce', $burger->description());
    }

    /** @test */
    public function get_burger_with_bacon_description()
    {
        $burger = new BurgerDoubleViande();
        $burgerBacon = new BaconDecorator($burger);
        $this->assertStringContainsString('Hamburger with 2 steacks, some salad and tomato, special sauce', $burgerBacon->description());
        $this->assertStringContainsString('Supplément Bacon croustillant', $burgerBacon->description());
    }

    /** @test */
    public function get_burger_with_bacon_and_cheese_description()
    {
        $burger = new BurgerDoubleViande();
        $burgerBacon = new BaconDecorator($burger);
        $burgerBaconCheese = new FromageDecorator($burgerBacon);
        $this->assertStringContainsString('Hamburger with 2 steacks, some salad and tomato, special sauce', $burgerBaconCheese->description());
        $this->assertStringContainsString('Supplément Bacon croustillant', $burgerBaconCheese->description());
        $this->assertStringContainsString('Supplément fromage fondant', $burgerBaconCheese->description());
    }
}
