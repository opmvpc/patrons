<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Factory\AbstractFactory\Voiture;

use Opmvpc\Patrons\Factory\AbstractFactory\Batteries\AbstractBatterie;
use Opmvpc\Patrons\Factory\AbstractFactory\Moteurs\AbstractMoteur;

class Voiture
{
    private AbstractMoteur $moteur;

    private AbstractBatterie $batterie;

    public function __construct(AbstractMoteur $moteur, AbstractBatterie $batterie)
    {
        $this->moteur = $moteur;
        $this->batterie = $batterie;
    }
}
