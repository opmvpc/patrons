<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Behavioral\Observer;

class Invoice extends Observed
{
    /**
     * @var array
     */
    private array $state = [];

    public function getState(): array
    {
        return $this->state;
    }

    /**
     * @param string $attribute
     * @return mixed
     */
    public function getAttribute(string $attribute)
    {
        return $this->state[$attribute];
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return void
     */
    public function setAttribute(string $attribute, $value): void
    {
        if ($this->state[$attribute] !== $value) {
            $this->state[$attribute] = $value;
            $this->notify();
        }
    }
}
