<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Composite;

class File extends Component
{
    public function children(): array
    {
        return [];
    }

    public function isSameAs(Component $component): bool
    {
        return $this->name === $component->name && get_class($component) === File::class;
    }

    public function isInSameFolderAs(File $component): bool
    {
        return $this->parent === $component->parent();
    }
}
