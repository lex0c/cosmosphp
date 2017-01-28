<?php
namespace Cosmos\Collections\Ordinations;

use \Cosmos\Collections\Interfaces\ListInterface;
use \Cosmos\Collections\Interfaces\SortableInterface;

/**
 * Bubble Sort
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Ordinations
 */
class BubbleSort implements SortableInterface
{
    /**
     * @var bool
     */
    protected $ordered = false;

    /**
     * Method for integration with implementation.
     *
     * @param ListInterface $data
     *
     * @return ListInterface
     */
    public function sort(ListInterface $data):ListInterface
    {
        return $this->bubbleSort($data);
    }

    /**
     * Sorts data in ascending order.
     *
     * @param ListInterface $data
     *
     * @return ListInterface
     */
    protected function bubbleSort(ListInterface $data):ListInterface
    {
        for ($i = $data->size(); $i > 1; $i--) {
            $this->ordered = true;
            for ($j = 1; $j < $i; $j++) {
                if ($data->get($j - 1) > $data->get($j)) {
                    $aux = $data->get($j);
                    $data->set($j, $data->get($j - 1));
                    $data->set($j - 1, $aux);
                    $this->ordered = false;
                }
            }
            if ($this->ordered) {
                break;
            }
        }

        return $data;
    }

}
