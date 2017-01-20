<?php
namespace Cosmos\Collections;

use \Cosmos\Collections\Exceptions\CollectionKeyInUseException;
use \Cosmos\Collections\Exceptions\CollectionKeyInvalidException;

class Collection implements \IteratorAggregate
{
    protected $data = [];

    public function getIterator()
    {
        return new CollectionIterator($this);
    }

    public function add($item, $key = null)
    {
        if ($key === null) {
            // Key is null, simply insert new data
            $this->data[] = $item;
        } else {
            // Key was specified, check if key exists
            if (isset($this->data[$key])) {
                throw new CollectionKeyInUseException($key);
            } else {
                $this->data[$key] = $item;
            }
        }
    }

    public function get($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            throw new CollectionKeyInvalidException($key);
        }
    }

    public function remove($key)
    {
        // Check if key exists
        if (!isset($this->data[$key])) {
            throw new CollectionKeyInvalidException($key);
        } else {
            unset($this->data[$key]);
        }
    }

    public function getAll()
    {
        return $this->data;
    }

    public function keys()
    {
        return array_keys($this->data);
    }

    public function length()
    {
        return count($this->data);
    }

    public function clear()
    {
        $this->data = array();
    }

    public function exists($key)
    {
        return isset($this->data[$key]);
    }

}
