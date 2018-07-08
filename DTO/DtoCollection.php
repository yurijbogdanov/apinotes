<?php

namespace DTO;

use ArrayIterator;
use Closure;

/**
 * Class DtoCollection
 * @package DTO
 */
class DtoCollection implements DtoCollectionInterface
{
    /**
     * An array containing the entries of this collection.
     *
     * @var array
     */
    private $elements;

    /**
     * Initializes a new DtoCollection.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * @inheritdoc
     */
    public function first()
    {
        return \reset($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function last()
    {
        return \end($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return \key($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        return \next($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return \current($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function remove($key)
    {
        if (!isset($this->elements[$key]) && !\array_key_exists($key, $this->elements)) {
            return null;
        }

        $removed = $this->elements[$key];
        unset($this->elements[$key]);

        return $removed;
    }

    /**
     * @inheritdoc
     */
    public function removeElement($element): bool
    {
        $key = \array_search($element, $this->elements, true);

        if ($key === false) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function containsKey($key): bool
    {
        return isset($this->elements[$key]) || \array_key_exists($key, $this->elements);
    }

    /**
     * @inheritdoc
     */
    public function contains($element): bool
    {
        return \in_array($element, $this->elements, true);
    }

    /**
     * @inheritdoc
     */
    public function exists(Closure $func): bool
    {
        foreach ($this->elements as $key => $element) {
            if ($func($key, $element)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function indexOf($element)
    {
        return \array_search($element, $this->elements, true);
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        return $this->elements[$key] ?? null;
    }

    /**
     * @inheritdoc
     */
    public function getKeys(): array
    {
        return \array_keys($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function getValues(): array
    {
        return \array_values($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return \count($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value): void
    {
        $this->elements[$key] = $value;
    }

    /**
     * @inheritdoc
     */
    public function add($element): bool
    {
        $this->elements[] = $element;

        return true;
    }

    /**
     * @inheritdoc
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function map(Closure $func): DtoCollectionInterface
    {
        return $this->createFrom(\array_map($func, $this->elements));
    }

    /**
     * @inheritdoc
     */
    public function filter(Closure $func): DtoCollectionInterface
    {
        return $this->createFrom(\array_filter($this->elements, $func));
    }

    /**
     * @inheritdoc
     */
    public function forAll(Closure $func): bool
    {
        foreach ($this->elements as $key => $element) {
            if (!$func($key, $element)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function partition(Closure $func): array
    {
        $matches = $noMatches = [];

        foreach ($this->elements as $key => $element) {
            if ($func($key, $element)) {
                $matches[$key] = $element;
            } else {
                $noMatches[$key] = $element;
            }
        }

        return [$this->createFrom($matches), $this->createFrom($noMatches)];
    }

    /**
     * @inheritdoc
     */
    public function clear(): void
    {
        $this->elements = [];
    }

    /**
     * @inheritdoc
     */
    public function slice(int $offset, int $length = null): array
    {
        return \array_slice($this->elements, $offset, $length, true);
    }

    /**
     * @inheritdoc
     */
    public function replace(array $elements): void
    {
        $this->elements = $elements;
    }

    /**
     * @inheritdoc
     */
    public function merge(array $elements): void
    {
        $this->elements = \array_merge($this->elements, $elements);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        if (!isset($offset)) {
            $this->add($value);
            return;
        }

        $this->set($offset, $value);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * Required by interface IteratorAggregate.
     *
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . '@' . \spl_object_hash($this);
    }

    /**
     * Creates a new instance from the specified elements.
     *
     * This method is provided for derived classes to specify how a new instance should be created when constructor semantics have changed.
     *
     * @param array $elements Elements.
     *
     * @return DtoCollectionInterface
     */
    protected function createFrom(array $elements)
    {
        return new static($elements);
    }
}
