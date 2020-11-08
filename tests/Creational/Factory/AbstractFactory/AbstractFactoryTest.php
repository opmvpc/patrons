<?php

namespace Opmvpc\Patrons\Creational\Tests\Singleton;

use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Batteries\GrosseBatterie;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Batteries\PetiteBatterie;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\FactoryElectric;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\FactoryPetrol;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Moteurs\MoteurElectric;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Moteurs\MoteurExplosion;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Voiture\Voiture;
use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    /** @test */
    public function it_can_create_a_petrol_car()
    {
        $factory = new FactoryPetrol();
        $moteur = $factory->createMoteur();
        $this->assertInstanceOf(MoteurExplosion::class, $moteur);
        $batterie = $factory->createBatterie();
        $this->assertInstanceOf(PetiteBatterie::class, $batterie);
        $voiture = $factory->createVoiture($moteur, $batterie);
        $this->assertInstanceOf(Voiture::class, $voiture);
    }

    /** @test */
    public function it_can_create_an_electric_car()
    {
        $factory = new FactoryElectric();
        $moteur = $factory->createMoteur();
        $this->assertInstanceOf(MoteurElectric::class, $moteur);
        $batterie = $factory->createBatterie();
        $this->assertInstanceOf(GrosseBatterie::class, $batterie);
        $voiture = $factory->createVoiture($moteur, $batterie);
        $this->assertInstanceOf(Voiture::class, $voiture);
    }
}
