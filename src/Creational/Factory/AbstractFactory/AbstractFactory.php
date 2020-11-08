<?php


declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Factory\AbstractFactory;

use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Batteries\AbstractBatterie;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Moteurs\AbstractMoteur;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Voiture\Voiture;

abstract class AbstractFactory
{
    abstract public function createMoteur(): AbstractMoteur;

    abstract public function createBatterie(): AbstractBatterie;

    public function createVoiture(AbstractMoteur $moteur, AbstractBatterie $batterie): Voiture
    {
        return new Voiture($moteur, $batterie);
    }
}
