<?php

namespace DTO;

use ArrayAccess;
use Closure;
use Countable;
use IteratorAggregate;

/**
 * Interface DtoCollectionInterface
 * @package DTO
 */
interface DtoCollectionInterface extends Countable, IteratorAggregate, ArrayAccess
{
    /**
     * Adds an element at the end of the collection.
     *
     * @param mixed $element The element to add.
     *
     * @return bool Always TRUE.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::add
     */
    public function add($element): bool;

    /**
     * Clears the collection, removing all elements.
     *
     * @return void
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::clear
     */
    public function clear(): void;

    /**
     * Checks whether an element is contained in the collection.
     * This is an O(n) operation, where n is the size of the collection.
     *
     * @param mixed $element The element to search for.
     *
     * @return bool TRUE if the collection contains the element, FALSE otherwise.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::contains
     */
    public function contains($element): bool;

    /**
     * Checks whether the collection is empty (contains no elements).
     *
     * @return bool TRUE if the collection is empty, FALSE otherwise.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::isEmpty
     */
    public function isEmpty(): bool;

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param string|int $key The kex/index of the element to remove.
     *
     * @return mixed The removed element or NULL, if the collection did not contain the element.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::remove
     */
    public function remove($key);

    /**
     * Removes the specified element from the collection, if it is found.
     *
     * @param mixed $element The element to remove.
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::removeElement
     */
    public function removeElement($element): bool;

    /**
     * Checks whether the collection contains an element with the specified key/index.
     *
     * @param string|int $key The key/index to check for.
     *
     * @return bool TRUE if the collection contains an element with the specified key/index, FALSE otherwise.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::containsKey
     */
    public function containsKey($key): bool;

    /**
     * Gets the element at the specified key/index.
     *
     * @param string|int $key The key/index of the element to retrieve.
     *
     * @return mixed
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::get
     */
    public function get($key);

    /**
     * Gets all keys/indices of the collection.
     *
     * @return array The keys/indices of the collection, in the order of the corresponding elements in the collection.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::getKeys
     */
    public function getKeys(): array;

    /**
     * Gets all values of the collection.
     *
     * @return array The values of all elements in the collection, in the order they appear in the collection.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::getValues
     */
    public function getValues(): array;

    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param string|int $key   The key/index of the element to set.
     * @param mixed      $value The element to set.
     *
     * @return void
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::set
     */
    public function set($key, $value): void;

    /**
     * Gets a native PHP array representation of the collection.
     *
     * @return array
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::toArray
     */
    public function toArray(): array;

    /**
     * Sets the internal iterator to the first element in the collection and returns this element.
     *
     * @return mixed
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::first
     */
    public function first();

    /**
     * Sets the internal iterator to the last element in the collection and returns this element.
     *
     * @return mixed
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::last
     */
    public function last();

    /**
     * Gets the key/index of the element at the current iterator position.
     *
     * @return int|string
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::key
     */
    public function key();

    /**
     * Gets the element of the collection at the current iterator position.
     *
     * @return mixed
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::current
     */
    public function current();

    /**
     * Moves the internal iterator position to the next element and returns this element.
     *
     * @return mixed
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::next
     */
    public function next();

    /**
     * Tests for the existence of an element that satisfies the given predicate.
     *
     * @param Closure $func The predicate.
     *
     * @return bool TRUE if the predicate is TRUE for at least one element, FALSE otherwise.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::exists
     */
    public function exists(Closure $func): bool;

    /**
     * Returns all the elements of this collection that satisfy the predicate $func.
     * The order of the elements is preserved.
     *
     * @param Closure $func The predicate used for filtering.
     *
     * @return DtoCollectionInterface A collection with the results of the filter operation.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::filter
     */
    public function filter(Closure $func): DtoCollectionInterface;

    /**
     * Tests whether the given predicate p holds for all elements of this collection.
     *
     * @param Closure $func The predicate.
     *
     * @return bool TRUE, if the predicate yields TRUE for all elements, FALSE otherwise.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::forAll
     */
    public function forAll(Closure $func): bool;

    /**
     * Applies the given function to each element in the collection and returns a new collection with the elements returned by the function.
     *
     * @param Closure $func
     *
     * @return DtoCollectionInterface
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::map
     */
    public function map(Closure $func): DtoCollectionInterface;

    /**
     * Partitions this collection in two collections according to a predicate.
     * Keys are preserved in the resulting collections.
     *
     * @param Closure $func The predicate on which to partition.
     *
     * @return DtoCollectionInterface[] An array with two elements. The first element contains the collection
     *                                  of elements where the predicate returned TRUE, the second element
     *                                  contains the collection of elements where the predicate returned FALSE.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::partition
     */
    public function partition(Closure $func): array;

    /**
     * Gets the index/key of a given element. The comparison of two elements is strict, that means not only the value but also the type must match.
     * For objects this means reference equality.
     *
     * @param mixed $element The element to search for.
     *
     * @return int|string|bool The key/index of the element or FALSE if the element was not found.
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::indexOf
     */
    public function indexOf($element);

    /**
     * Extracts a slice of $length elements starting at position $offset from the Collection.
     *
     * If $length is null it returns all elements from $offset to the end of the Collection.
     * Keys have to be preserved by this method. Calling this method will only return the
     * selected slice and NOT change the elements contained in the collection slice is called on.
     *
     * @param int      $offset The offset to start from.
     * @param int|null $length The maximum number of elements to return, or null for no limit.
     *
     * @return array
     *
     * @see \Doctrine\Common\Collections\ArrayCollection::slice
     */
    public function slice(int $offset, ?int $length = null): array;

    /**
     * Replace the Collections elements with new $elements
     *
     * @param array $elements
     *
     * @return void
     */
    public function replace(array $elements): void;

    /**
     * Merge the Collections elements with new $elements
     *
     * @param array $elements
     *
     * @return void
     */
    public function merge(array $elements): void;
}
