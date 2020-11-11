<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Composite;

use Exception;

class Folder extends Component
{
    private array $children = [];

    public function children(): array
    {
        return $this->children;
    }

    public function create(Component $component): void
    {
        if ($this->findChildByName($component->name())) {
            throw new Exception("Error: {$component->name()} already exists", 1);
        }
        $this->children[] = $component;
    }

    public function delete(string $componentName): void
    {
        $component = $this->findChildByName($componentName);
        if ($component === null) {
            throw new Exception('Error: Folder or File does not exist in the current folder', 1);
        } elseif (get_class($component) === File::class) {
            unset($this->children[$this->findChildId($component) ?? -1]);
        } elseif (get_class($component) === Folder::class) {
            unset($this->children[$this->findChildId($component) ?? -1]);
        }
    }

    public function isSameAs(Component $component): bool
    {
        return $this->isSameAsRec($component, $this, true);
    }

    private function isSameAsRec(Component $componentToCompare, Component $currentComponent, bool $currentComponentIsFirstToCompare): bool
    {
        if ($currentComponent->name() !== $componentToCompare->name() && ! $currentComponentIsFirstToCompare) {
            return false;
        }

        $isSame = true;
        foreach ($currentComponent->children() as $key => $child) {
            $childToCompare = $componentToCompare->children()[$key];
            if ($this->isSameAsRec($childToCompare, $child, false) !== true) {
                $isSame = $this->isSameAsRec($childToCompare, $child, false);
            }
        }

        return $isSame;
    }

    public function findChildByName(string $name): ?Component
    {
        foreach ($this->children as $child) {
            if ($child->name() === $name) {
                return $child;
            }
        }

        return null;
    }

    public function findChildId(Component $component): ?int
    {
        foreach ($this->children as $key => $child) {
            if ($component === $child) {
                return $key;
            }
        }

        return null;
    }
}
