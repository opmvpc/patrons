<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Composite;

use Exception;

class FileManager
{
    /**
     *
     * @var Folder
     */
    private Folder $root;

    /**
     *
     * @var Folder
     */
    private Folder $current;

    public function __construct()
    {
        $root = new Folder('/', null);
        $this->root = $root;
        $this->current = $root;
    }

    public function createFolder(string $name): void
    {
        $folder = new Folder($name, $this->current);
        $this->current->create($folder);
    }

    public function createFile(string $name): void
    {
        $file = new File($name, $this->current);
        $this->current->create($file);
    }

    public function find(string $componentName): ?Component
    {
        return $this->findRec($componentName, $this->root);
    }

    private function findRec(string $componentNameToFind, Component $currentComponent): ?Component
    {
        if ($currentComponent->name() === $componentNameToFind) {
            return $currentComponent;
        }

        $foundComponent = null;
        foreach ($currentComponent->children() as $child) {
            if ($this->findRec($componentNameToFind, $child) !== null) {
                $foundComponent = $this->findRec($componentNameToFind, $child);
            }
        }

        return $foundComponent;
    }

    public function goTo(string $path): ?Folder
    {
        $oldCurrent = $this->current;

        if ($path === '/') {
            $this->current = $this->root;

            return $this->current;
        }

        if (substr($path, 0, 1) === '/') {
            $this->current = $this->root;
            $path = substr($path, 1, strlen($path) - 1);
        }

        $splitedPath = explode('/', $path);

        foreach ($splitedPath as $component) {
            if ($component === '.') {
                // do nothing
            } elseif ($component === '..') {
                if ($this->current === $this->root) {
                    // do nothing
                } else {
                    $this->current = $this->current->parent() ?? $this->root;
                }
            } else {
                $childFound = $this->current()->findChildByName($component);
                if ($childFound !== null) {
                    if (get_class($childFound) === Folder::class) {
                        $this->current = $childFound;
                    } elseif (get_class($childFound) === File::class) {
                        $this->current = $childFound->parent() ?? $this->root;
                    } else {
                        throw new Exception("Error: {$childFound->name()} is neather a folder or a file", 1);
                    }
                } else {
                    $this->current = $oldCurrent;

                    throw new Exception("Error: Invalid path", 1);
                }
            }
        }

        return $this->current;
    }

    public function root(): Folder
    {
        return $this->root;
    }

    public function current(): Folder
    {
        return $this->current;
    }

    public function copy(string $origine, string $destination): void
    {
        $this->copyOrMove($origine, $destination);
    }

    public function move(string $origine, string $destination): void
    {
        $this->copyOrMove($origine, $destination, true);
    }

    public function copyOrMove(string $origine, string $destination, bool $isMove = false): void
    {
        if ($origine === '/') {
            throw new Exception('Error: Can\'t move root folder', 1);
        }

        $this->goTo($origine);
        $fileName = explode('/', $origine);
        $fileName = $fileName[count($fileName) - 1];
        $toMove = $this->current()->findChildByName($fileName);
        if ($toMove !== null && get_class($toMove) === File::class) {
            if ($isMove === true) {
                $this->current()->delete($fileName);
            }
        } else {
            $toMove = $this->current;
            $this->goTo('..');
            if ($isMove === true) {
                $this->current()->delete($toMove->name());
            }
        }
        $this->goTo($destination);
        $this->current->create($toMove);
    }
}
