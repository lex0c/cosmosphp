<?php
namespace Cosmos\Collections;

/**
 * Array Queue
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections
 */
class ArrayQueue extends AbstractArrayable
{
    /**
     *
     */
    protected $limit;

    /**
     *
     */
    protected $full = false;

    /**
     *
     */
    protected $locked = false;

    /**
     *
     */
    protected $processQueue = [];

    /**
     *
     */
    public function __construct(int $limit)
    {
        parent::__construct();

        // ...
        $this->limit = $limit;
        $this->arrayable = new ArrayList();
    }

    /**
     *
     */
    public function enQueue()
    {}

    /**
     *
     */
    public function deQueue()
    {}

    /**
     *
     */
    public function isEmpty():bool
    {}

    /**
     *
     */
    public function get()
    {}

    /**
     *
     */
    public function check()
    {}

    /**
     *
     */
    public function lock()
    {}

    /**
     *
     */
    public function unLock()
    {}

    /**
     *
     */
    public function isFull()
    {}

    /**
     *
     */
    protected function isMaxLimit()
    {}

    /**
     *
     */
    protected function process()
    {}

}
