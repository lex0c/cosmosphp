<?php
namespace Cosmos\Collections;

/**
 * Abstract Arrayable
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections
 */
abstract class AbstractArrayable
{
    /**
     * Manipulable array by yours daughters.
     *
     * @var array
     */
    protected $arrayable = null;

    /**
     * Constructor of Arrayable.
     */
    public function __construct()
    {
        $this->arrayable = [];
    }

    /**
     * Returns true if this list contains no elements.
     *
     * @return bool
     */
    public function isEmpty():bool
    {
        return empty($this->getAll());
    }

    /**
     * Returns a shallow copy of this ArrayList instance.
     *
     * @return AbstractArrayable
     */
    public function cloneThis():AbstractArrayable
    {
        return clone($this);
    }

    /**
     * Returns all keys of collection;
     *
     * @return array
     */
    public function keys():array
    {
        return array_keys($this->getAll());
    }

    /**
     * Removes all of the elements from this list.
     *
     * @return void
     */
    public function clear()
    {
        $this->arrayable = [];
    }

    /**
     * Returns the number of elements in this list.
     *
     * @return int
     */
    public function size():int
    {
        return ((count($this->arrayable)) > 0) ? count($this->arrayable) : -1;
    }

    /**
     * Returns all elements in this list.
     *
     * @param bool $filter
     *
     * @return array
     */
    public function getAll(bool $filter = true):array
    {
        if ($filter) {
            return array_filter($this->arrayable);
        }

        return $this->arrayable;
    }

}
