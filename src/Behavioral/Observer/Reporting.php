<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Behavioral\Observer;

use SplSubject;

class Reporting extends Observer
{
    public function update(SplSubject $subject): void
    {
        parent::update($subject);
        // Example: Update reporting data and generate new graphs
        // $this->updateReport($subject->getState());
    }
}
