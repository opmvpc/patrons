<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Singleton;

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
}
