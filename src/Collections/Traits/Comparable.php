<?php
namespace Cosmos\Collections\Traits;

/**
 * Comparable
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Traits
 */
trait Comparable
{
    /**
     * Compare if the element already exists in array.
     *
     * @param mixed $element
     * @param $array $array
     *
     * @return boolean
     */
    protected function isEquals($element, array $array):bool
    {

        for ($i = 0; $i < count($array); $i++) {
            if ($element === $array[$i]) {
                return true;
            }
        }

        return false;
    }

    /**
     * Compare if the key already exists in array.
     *
     * @param int    $key
     * @param $array $array
     *
     * @return boolean
     */
    protected function keyExists(int $key, array $array):bool
    {
        if (array_key_exists($key, $array)) {
            return true;
        }

        return false;
    }

}
