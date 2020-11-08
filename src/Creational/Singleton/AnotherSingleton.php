<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Singleton;

class AnotherSingleton extends SingletonGeneric
{
    public function hello(): string
    {
        return 'coucou!';
    }
}
