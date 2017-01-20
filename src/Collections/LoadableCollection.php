<?php
namespace Cosmos\Collections;

use \Cosmos\Collections\Exceptions\CollectionCallbackInvalidException;

class LoadableCollection extends Collection
{
    protected $onLoad  = null;
    protected $isLoaded = false;

    public function setLoadCallback($callback)
    {
        if (!is_callable($callback, false, $callableName)) {
            throw new CollectionCallbackInvalidException($callableName . ' is not callable as a parameter to onLoad.');
        }

        $this->onLoad = $callback;
    }

    protected function checkCallback()
    {
        if (!$this->isLoaded) {
            $this->isLoaded = true;
            if ($this->onLoad === NULL) {

                if (method_exists($this, 'load')) {
                    $this->onLoad = array($this, 'load');
                } else {
                    throw new CollectionCallbackInvalidException('No valid callback set and no load() method found');
                }
            }
            call_user_func($this->onLoad, $this);
        }
    }

    public function addItem($item, $key = null)
    {
        $this->checkCallback();
        parent::add($item, $key);
    }

    public function getItem($key)
    {
        $this->checkCallback();
        return parent::get($key);
    }

    public function getItems()
    {
        $this->checkCallback();
        return parent::getAll();
    }

    public function removeItem($key)
    {
        $this->checkCallback();
        parent::remove($key);
    }

    public function exists($key)
    {
        $this->checkCallback();
        return parent::exists($key);
    }

    public function keys()
    {
        $this->checkCallback();
        return parent::keys();
    }

    public function length()
    {
        $this->checkCallback();
        return parent::length();
    }

    public function clear()
    {
        $this->checkCallback();
        return parent::clear();
    }


    public function unload()
    {
        $this->clear();
        $this->isLoaded = false;
        $this->onLoad = null;
    }

}
