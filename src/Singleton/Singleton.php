<?php
declare(strict_types=1);

namespace Opmvpc\Patrons\Singleton;

/**
 * @psalm-immutable
 */
class Singleton
{
    private static ?Singleton $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): Singleton
    {
        if (static::$instance === null) {
            static::$instance = new Singleton();
        }

        return static::$instance;
    }
}
