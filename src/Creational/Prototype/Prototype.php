<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Creational\Prototype;

abstract class Prototype implements \ArrayAccess
{
    /**
     * @var array
     */
    protected array $attributes = [];

    abstract public function draw(): void;

    /**
     * @psalm-suppress MissingReturnTypes
     */
    public function __clone()
    {
        $attributesCopy = [];
        foreach ($this->attributes as $attributeKey => $attributeValue) {
            if (is_array($attributeValue)) {
                $iterableCopy = [];
                foreach ($attributeValue as $key => $value) {
                    $value = (object)$value;
                    $iterableCopy[$key] = clone $value;
                }
                $attributesCopy[$attributeKey] = $iterableCopy;
            } else {
                $attributesCopy[$attributeKey] = $attributeValue;
            }
        }
    }

    /**
     * @template T
     * @param $offset
     * @psalm-param T $value
     * @return void
    */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->attributes[] = $value;
        } else {
            $this->attributes[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->attributes[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->attributes[$offset]);
    }

    /**
     * @template T
     * @param $offset
     * @return ?T
     */
    public function offsetGet($offset)
    {
        return isset($this->attributes[$offset]) ? $this->attributes[$offset] : null;
    }
}
