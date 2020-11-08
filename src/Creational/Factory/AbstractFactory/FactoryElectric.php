<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Factory\AbstractFactory;

use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Batteries\AbstractBatterie;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Batteries\GrosseBatterie;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Moteurs\AbstractMoteur;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Moteurs\MoteurElectric;

class FactoryElectric extends AbstractFactory
{
    public function __construct()
    {
    }

    public function createMoteur(): AbstractMoteur
    {
        return new MoteurElectric();
    }

    public function createBatterie(): AbstractBatterie
    {
        return new GrosseBatterie();
    }
}
