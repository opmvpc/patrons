<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Singleton;

use BadMethodCallException;

abstract class SingletonGeneric
{
    /**
     * @var array
     */
    private static array $instances = [];

    /**
     *
     * @return void
     */
    final protected function __construct()
    {
    }

    public static function getInstance(): self
    {
        $class = get_called_class();

        if (! array_key_exists($class, static::$instances)) {
            SingletonGeneric::$instances[$class] = new static();
        }

        return static::$instances[$class];
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
