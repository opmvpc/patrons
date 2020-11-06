<?php
declare(strict_types=1);

namespace Opmvpc\Patrons\Singleton;

/**
 * @psalm-immutable
 */
class SingletonGeneric
{
    private static ?SingletonGeneric $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): SingletonGeneric
    {
        if (static::$instance === null) {
            static::$instance = new SingletonGeneric();
        }

        return static::$instance;
    }
}
