<?php


declare(strict_types=1);

namespace Opmvpc\Patrons\Factory\AbstractFactory;

use Opmvpc\Patrons\Factory\AbstractFactory\Batteries\AbstractBatterie;
use Opmvpc\Patrons\Factory\AbstractFactory\Moteurs\AbstractMoteur;
use Opmvpc\Patrons\Factory\AbstractFactory\Voiture\Voiture;

abstract class AbstractFactory
{
    abstract public function createMoteur(): AbstractMoteur;

    abstract public function createBatterie(): AbstractBatterie;

    public function createVoiture(AbstractMoteur $moteur, AbstractBatterie $batterie): Voiture
    {
        return new Voiture($moteur, $batterie);
    }
}
