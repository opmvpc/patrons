<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Singleton\Dict;

use Opmvpc\Patrons\Creational\Singleton\SingletonGeneric;

abstract class DictSingleton extends SingletonGeneric
{
    /**
     * @var array
     */
    protected array $terms;

    /**
     * @var string
     */
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
