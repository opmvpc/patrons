<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Singleton;

use BadMethodCallException;

/**
 * @psalm-immutable
 */
class Singleton
{
    /**
     * @var null|Singleton
     */
    private static ?Singleton $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (static::$instance === null) {
            Singleton::$instance = new Singleton();
        }

        return static::$instance;
    }

    public function __clone()
    {
        throw new BadMethodCallException('Unauthorized operation');
    }

    public function __wakeup()
    {
        throw new BadMethodCallException('Unauthorized operation');
    }
}
