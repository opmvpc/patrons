<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Behavioral\Observer;

use SplObjectStorage;
use SplObserver;
use SplSubject;

abstract class Observed implements SplSubject
{
    /**
     * @var SplObjectStorage
     */
    private SplObjectStorage $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
