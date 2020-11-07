<?php


declare(strict_types=1);

namespace Opmvpc\Patrons\Factory\AbstractFactory;

use Opmvpc\Patrons\Factory\AbstractFactory\Batteries\AbstractBatterie;
use Opmvpc\Patrons\Factory\AbstractFactory\Batteries\GrosseBatterie;
use Opmvpc\Patrons\Factory\AbstractFactory\Moteurs\AbstractMoteur;
use Opmvpc\Patrons\Factory\AbstractFactory\Moteurs\MoteurElectric;

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
