<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Factory\AbstractFactory\Voiture;

use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Batteries\AbstractBatterie;
use Opmvpc\Patrons\Creational\Factory\AbstractFactory\Moteurs\AbstractMoteur;

class Voiture
{
    /**
     *
     * @var AbstractMoteur
     */
    private AbstractMoteur $moteur;

    /**
     *
     * @var AbstractBatterie
     */
    private AbstractBatterie $batterie;

    public function __construct(AbstractMoteur $moteur, AbstractBatterie $batterie)
    {
        $this->moteur = $moteur;
        $this->batterie = $batterie;
    }
}
