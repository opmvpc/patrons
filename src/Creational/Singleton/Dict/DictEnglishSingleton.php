<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Singleton\Dict;

class DictEnglishSingleton extends DictSingleton
{
    protected string $lang = 'en';

    protected array $terms = [
        'salutation' => 'Hi!',
    ];
}
