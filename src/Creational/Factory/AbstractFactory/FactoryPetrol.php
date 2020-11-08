<?php


declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Factory\AbstractFactory;

use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Batteries\AbstractBatterie;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Batteries\PetiteBatterie;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Moteurs\AbstractMoteur;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Moteurs\MoteurExplosion;

class FactoryPetrol extends AbstractFactory
{
    public function __construct()
    {
    }

    public function createMoteur(): AbstractMoteur
    {
        return new MoteurExplosion();
    }

    public function createBatterie(): AbstractBatterie
    {
        return new PetiteBatterie();
    }
}
