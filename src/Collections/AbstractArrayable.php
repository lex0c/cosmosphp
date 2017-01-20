<?php
namespace Cosmos\Collections;

use \IteratorAggregate;
use \Cosmos\Collections\Interfaces\CollectionInterface;

/**
 * Abstract Arrayable
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections
 */
abstract class AbstractArrayable implements IteratorAggregate, CollectionInterface
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
        return empty($this->arrayable);
    }

    /**
     * Returns a shallow copy of this ArrayList instance.
     *
     * @return AbstractArrayable
     */
    public function clone():AbstractArrayable
    {
        return clone($this);
    }

    public function keys():array
    {
        return array_keys($this->arrayable);
    }

    /**
     * Removes all of the elements from this list.
     *
     * @return bool
     */
    public function clear():bool
    {
        $this->arrayable = [];
        return true;
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

    public function getAll():array
    {
        return $this->arrayable;
    }

}
