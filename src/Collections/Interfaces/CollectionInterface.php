<?php
namespace Cosmos\Collections\Interfaces;

use \Cosmos\Collections\Exceptions\IndexBoundsException;
use \Cosmos\Collections\Exceptions\NullPointerException;
use \Cosmos\Collections\AbstractArrayable;

/**
 * Collection Interface
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Interfaces
 */
interface CollectionInterface
{
    /**
     * Appends the specified element to the end of this list.
     * 
     * @param mixed $element
     * 
     * @return bool
     */
    public function add($element):bool;

    /**
     * Inserts the specified element at the specified position in this list.
     * 
     * @param int $index 
     * @param mixed $element
     * 
     * @return bool
     * 
     * @throws IndexBoundsException
     */
    public function addIn(int $index, $element):bool;

    /**
     * Replaces the element at the specified position in this list 
     * with the specified element.
     * 
     * @param int $index
     * @param mixed $element
     * 
     * @return bool
     * 
     * @throws IndexBoundsException
     */
    public function set(int $index, $element):bool;

    /**
     * Appends all of the elements in the specified collection to 
     * the end of this list.
     * 
     * @param CollectionInterface $array
     * 
     * @return bool
     *
     * @throws NullPointerException
     */
    public function merge(CollectionInterface $array):bool;

    /**
     * Returns the element at the specified position in this list.
     *
     * @param int $index
     * 
     * @return mixed
     *
     * @throws IndexBoundsException
     */
    public function get(int $index);

    /**
     * Returns all elements in this list.
     *
     * @return array
     */
    public function getAll():array;

    /**
     * Returns true if this list contains the specified element.
     * 
     * @param mixed $element
     * 
     * @return bool
     */
    public function contains($element):bool;

    /**
     * Returns the index of the first occurrence of the specified 
     * element in this list, or -1 if this list does not contain the element.
     * 
     * @param mixed $element
     * 
     * @return int
     */
    public function indexOf($element):int;

    /**
     * Returns the index of the last occurrence of the specified element 
     * in this list, or -1 if this list does not contain the element.
     * 
     * @param mixed $element
     * 
     * @return int
     */
    public function lastIndexOf($element):int;

    /**
     * Removes the element at the specified position in this list.
     *
     * @param int $index
     * 
     * @return bool
     *
     * @throws IndexBoundsException
     */
    public function remove(int $index):bool;

    /**
     * Removes the first occurrence of the specified element from this list.
     * 
     * @param mixed $element
     * 
     * @return bool
     */
    public function removeByElement($element):bool;

    /**
     * Removes from this list all of the elements whose index is between fromIndex, 
     * inclusive, and toIndex, inclusive.
     * 
     * @param int $fromIndex
     * @param int $toIndex
     * 
     * @return bool
     * 
     * @throws IndexBoundsException
     */
    public function removeRange(int $fromIndex, int $toIndex):bool;

    /**
     * Returns a view of the portion of this list between the specified fromIndex, 
     * inclusive, and toIndex, inclusive.
     * 
     * @param int $fromIndex
     * @param int $toIndex
     * 
     * @return array
     * 
     * @throws IndexBoundsException
     */
    public function subList(int $fromIndex, int $toIndex):array;
    
    /**
     * Returns true if this list contains no elements.
     * 
     * @return bool
     */
    public function isEmpty():bool;

    /**
     * Returns a shallow copy of this ArrayList instance.
     * 
     * @return AbstractArrayable
     */
    public function clone():AbstractArrayable;

    /**
     * Removes all of the elements from this list.
     * 
     * @return void
     */
    public function clear();
    /**
     * Returns the number of elements in this list.
     * 
     * @return int
     */
    public function size():int;

    /**
     * Returns all keys of collection;
     *
     * @return array
     */
    public function keys():array;

}
