<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Composite;

abstract class Component
{
    /**
     *
     * @var string
     */
    protected string $name;

    /**
     *
     * @var null|Folder
     */
    protected ?Folder $parent = null;

    public function __construct(string $name, ?Folder $parent)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    abstract public function children(): array;

    public function name(): string
    {
        return $this->name;
    }

    public function parent(): ?Folder
    {
        return $this->parent;
    }

    abstract public function isSameAs(Component $component): bool;
}
