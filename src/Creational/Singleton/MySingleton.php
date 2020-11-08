<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Singleton;

class MySingleton extends SingletonGeneric
{
    public function hello(): string
    {
        return 'hello!';
    }
}
