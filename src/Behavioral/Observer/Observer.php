<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Behavioral\Observer;

use SplObserver;
use SplSubject;

abstract class Observer implements SplObserver
{
    /**
     * Pour garder une trace de ce qu'il se passe
     * @var SplSubject[]
     */
    private array $notifiers = [];

    public function update(SplSubject $subject): void
    {
        $this->notifiers[] = clone $subject;
    }

    /**
     * @return SplSubject[]
     */
    public function getNotifiers(): array
    {
        return $this->notifiers;
    }
}
