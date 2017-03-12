<?php
namespace Cosmos\Collections;

use \Iterator;
use \IteratorAggregate;
use \Cosmos\Collections\Traits\Comparable;
use \Cosmos\Collections\Interfaces\ListInterface;
use \Cosmos\Collections\Interfaces\CollectionInterface;
use \Cosmos\Collections\Exceptions\IndexBoundsException;
use \Cosmos\Collections\Exceptions\NullPointerException;
use \Cosmos\Collections\Exceptions\InvalidElementTypeException;

/**
 * Array List
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections
 */
class ArrayList extends AbstractArrayable implements IteratorAggregate, ListInterface
{
    use Comparable;

    /**
     * Initialize constructor of Arrayable.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Appends the specified element to the end of this list.
     *
     * @param mixed $element
     * @param bool  $addEqual
     * @param bool  $recursive
     *
     * @return bool
     *
     * @throws InvalidElementTypeException
     */
    public function add($element, bool $addEqual = false, bool $recursive = false):bool
    {
        if (($recursive) && (is_array($element))) {
            $size = $this->size();
            for ($i = 0; $i < sizeof($element); $i++) {

                if (!$addEqual) {
                    if (!$this->isEquals($element[$i], $this->getAll())) {
                        $this->set($size++, $element[$i]);
                    }
                } else {
                    $this->set($size++, $element[$i]);
                }

            }

            return true;
        } elseif (!$recursive) {

            if (!$addEqual) {
                if (!$this->isEquals($element, $this->getAll())) {
                    $this->arrayable[] = $element;
                    return true;
                }
            } else {
                $this->arrayable[] = $element;
                return true;
            }

        } else {
            throw new InvalidElementTypeException(
                "This element {$element} must be an array in recursive mode!");
        }

        return false;
    }

    /**
     * Inserts the specified element at the specified position in this list.
     *
     * @param int   $index
     * @param mixed $element
     * @param bool  $addEqual
     *
     * @return bool
     *
     * @throws NullPointerException
     */
    public function addIn(int $index, $element, bool $addEqual = false):bool
    {
        if ($index < $this->size()) {
            if (!$addEqual) {
                if (!$this->isEquals($element, $this->getAll())) {
                    $this->addWithPosition($index, $element);
                    return true;
                }
            } else {
                $this->addWithPosition($index, $element);
                return true;
            }
        }

        throw new NullPointerException();
    }

    /**
     * Replaces the element at the specified position in this list
     * with the specified element.
     *
     * @param int $index
     * @param mixed $element
     *
     * @return bool
     *
     * @throws NullPointerException
     */
    public function set(int $index, $element):bool
    {
        if ($index >= 0) {
            $this->arrayable[$index] = $element;
            return true;
        }

        throw new NullPointerException();
    }

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
    public function merge(CollectionInterface $collection):bool
    {
        if ($collection->size() != -1) {
            $y = $this->size();

            for ($i = 0; $i < $collection->size(); $i++) {
                $this->addWithPosition($y, $collection->get($i));
                $y++;
            }

            return true;
        }

        throw new IndexBoundsException();
    }

    /**
     * Returns the element at the specified position in this list.
     *
     * @param int $index
     *
     * @return mixed
     *
     * @throws IndexBoundsException
     */
    public function get(int $index)
    {
        if($this->keyExists($index, $this->getAll())):
            return $this->arrayable[$index];
        endif;

        throw new IndexBoundsException("This index '{$index}' not exists in this list!");
    }

    /**
     * Returns true if this list contains the specified element.
     *
     * @param mixed $element
     *
     * @return bool
     */
    public function contains($element):bool
    {
        return $this->isEquals($element, $this->getAll());
    }

    /**
     * Returns the index of the first occurrence of the specified
     * element in this list, or -1 if this list does not contain the element.
     *
     * @param mixed $element
     *
     * @return int
     */
    public function indexOf($element):int
    {
        $index = $this->isEquals($element, $this->getAll(), true);

        if ($index !== false) {
            return $index;
        }

        return -1;
    }

    /**
     * Returns the index of the last occurrence of the specified element
     * in this list, or -1 if this list does not contain the element.
     *
     * @param mixed $element
     *
     * @return int
     */
    public function lastIndexOf($element):int
    {
        $lastIndex = -1;
        for ($i = 0; $i < $this->size(); $i++) {
            if ($element === $this->get($i)) {
                $lastIndex = $i;
            }
        }

        return $lastIndex;
    }

    /**
     * Removes the element at the specified position in this list.
     *
     * @param int $index
     *
     * @return bool
     *
     * @throws IndexBoundsException
     */
    public function remove(int $index):bool
    {
        if (($this->keyExists($index, $this->getAll()))
            && ($this->keyExists($index + 1, $this->getAll()))) {
            $arr = [];

            for ($i = $index+1; $i < $this->size(); $i++) {
                $arr[] = $this->get($i);
            }

            $y = $index;
            $this->arrayable[$index] = null;
            for ($i = 0; $i < sizeof($arr); $i++) {
                $this->set($y, $arr[$i]);
                $y++;
            }

            unset($this->arrayable[$this->size()-1]);
            unset($arr);

            // Temporary solution to remove empty indexes after removal of elements ..
            $this->arrayable = array_values($this->arrayable);

            return true;
        } elseif (($this->keyExists($index, $this->getAll()))
            && (!$this->keyExists($index + 1, $this->getAll()))) {
            unset($this->arrayable[$index]);
            return true;
        }

        throw new IndexBoundsException("This index {$index} not exists in this list.");
    }

    /**
     * Removes the occurrences of the specified element from this list.
     *
     * @param mixed  $element
     * @param  bool  $firstOccurrence
     * @param  bool  $lastOccurrence
     *
     * @return bool
     */
    public function removeByElement($element, bool $firstOccurrence = true,
                                    bool $lastOccurrence = false):bool
    {
        if ($this->contains($element)) {
            if ((!$firstOccurrence) && (!$lastOccurrence)) {
                $firstOccurrence = true;
            }

            if (($firstOccurrence) && (!$lastOccurrence)) {
                $this->remove($this->indexOf($element));
            } elseif ((!$firstOccurrence) && ($lastOccurrence)) {
                $this->remove($this->lastIndexOf($element));
            } elseif (($firstOccurrence) && ($lastOccurrence)) {
                $this->remove($this->indexOf($element));
                $this->remove($this->lastIndexOf($element));
            }

            return true;
        }

        return false;
    }

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
    public function removeRange(int $fromIndex, int $toIndex):bool
    {
        if ($fromIndex < $toIndex) {
            $to = $toIndex;
            while ($fromIndex <= $to) {
                if ($this->remove($fromIndex)) {
                    $to--;
                }
            }

            return true;
        }

        throw new \InvalidArgumentException(
            "This fromIndex '{$fromIndex}' must be less than toIndex '{$toIndex}'.");
    }

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
    public function subList(int $fromIndex, int $toIndex):array
    {
        if ($fromIndex < $toIndex) {
            $arr = [];
            for ($i = $fromIndex; $i <= $toIndex; $i++) {
                $arr[] = $this->get($i);
            }

            return $arr;
        }

        throw new \InvalidArgumentException(
            "This fromIndex '{$fromIndex}' must be less than toIndex '{$toIndex}'.");
    }

    /**
     * Returns iterator of this ArrayList.
     *
     * @return Iterator
     */
    public function getIterator():Iterator
    {
        return new CollectionIterator($this);
    }

    /**
     * Inserts the specified element at the specified position in this list.
     *
     * @param int   $index
     * @param mixed $element
     *
     * @return void
     */
    protected function addWithPosition(int $index, $element)
    {
        if (($this->keyExists($index, $this->getAll()))
            && ($this->keyExists($index + 1, $this->getAll()))) {
            $arr = [];
            for ($i = $index; $i < $this->size(); $i++) {
                $arr[] = $this->get($i);
            }

            $y = $index + 1;
            $this->arrayable[$index] = $element;
            for ($i = 0; $i < count($arr); $i++) {
                $this->set($y, $arr[$i]);
                $y++;
            }

            unset($arr);
        } elseif (($this->keyExists($index, $this->getAll()))
            && (!$this->keyExists($index + 1, $this->getAll()))) {

            $var = $this->get($index);
            $this->set($index, $element);
            $this->set($index + 1, $var);

            unset($var);
        } elseif (!$this->keyExists($index, $this->getAll())) {
            $this->set($index, $element);
        }
    }

}
