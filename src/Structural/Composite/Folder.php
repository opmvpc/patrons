<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Composite;

class Folder extends Component
{
    private array $children = [];

    public function children(): array
    {
        return $this->children;
    }

    public function create(Component $component): void
    {
    }

    public function delete(Component $component): void
    {
    }

    public function move(Folder $destination): void
    {
    }

    public function copy(Folder $destination): void
    {
    }

    public function isSameAs(Folder $folder): bool
    {
        return true;
    }
}
