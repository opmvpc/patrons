<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Singleton\Dict;

use Opmvpc\Patrons\Singleton\SingletonGeneric;

abstract class DictSingleton extends SingletonGeneric
{
    protected array $terms;

    protected string $lang;

    public function get(string $key): ?string
    {
        return $this->terms[$key] ?? null;
    }

    public function getLang(): string
    {
        return $this->lang;
    }
}
