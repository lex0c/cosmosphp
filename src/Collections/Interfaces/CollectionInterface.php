<?php
namespace Cosmos\Collections\Interfaces;

use \Cosmos\Utils\Interfaces\Adapter;
use \Cosmos\Collections\AbstractArrayable;
use \Cosmos\Collections\Exceptions\IndexBoundsException;

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
     * Appends the specified element(s) to the end of this list.
     * 
     * @param mixed $element
     * @param bool  $recursive
     * 
     * @return bool
     */
    public function add($element, bool $recursive):bool;

    /**
     * Appends all of the elements in the specified collection to 
     * the end of this list.
     * 
     * @param CollectionInterface $collection
     * 
     * @return bool
     *
     * @throws IndexBoundsException
     */
    public function merge(CollectionInterface $collection):bool;

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
     * @param bool $filter
     *
     * @return array
     */
    public function getAll(bool $filter):array;

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
    public function cloneThis():AbstractArrayable;

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

}
