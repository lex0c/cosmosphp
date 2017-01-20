<?php
namespace Cosmos\Collections;

use \Iterator;
use \Cosmos\Collections\Interfaces\CollectionInterface;

/**
 * Collection Iterator
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections
 */
class CollectionIterator implements Iterator
{
    /**
     * Collection instance.
     *
     * @var Collection
     */
    protected $collection = null;

    /**
     * Current index
     *
     * @var integer
     */
    protected $currentIndex = 0;

    /**
     * Keys in collection
     *
     * @var mixed
     */
    protected $keys = null;

    /**
     * CollectionIterator constructor
     *
     * @param CollectionInterface $collection
     */
    public function __construct(CollectionInterface $collection)
    {
        // Assign collection
        $this->collection = $collection;
        // Assign keys from collection
        $this->keys = $collection->keys();
    }

    /**
     * Returns the current item in the collection in currentIndex.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->collection->get($this->key());
    }

    /**
     * Get current key.
     *
     * @return mixed
     */
    public function key()
    {
        return $this->keys[$this->currentIndex];
    }

    /**
     * Move to next index
     *
     * @return void
     */
    public function next():void
    {
        ++$this->currentIndex;
    }

    /**
     * Reset the currentIndex.
     *
     * @return void
     */
    public function rewind():void
    {
        $this->currentIndex = 0;
    }

    /**
     * Checks whether the currentIndex is valid.
     *
     * @return boolean
     */
    public function valid():bool
    {
        return isset($this->keys[$this->currentIndex]);
    }

}
