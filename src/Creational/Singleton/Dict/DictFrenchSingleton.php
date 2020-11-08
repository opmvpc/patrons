<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Singleton\Dict;

class DictFrenchSingleton extends DictSingleton
{
    protected string $lang = 'fr';

    protected array $terms = [
        'salutation' => 'Bonjour!',
    ];
}
