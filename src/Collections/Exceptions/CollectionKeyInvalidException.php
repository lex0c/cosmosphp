<?php
namespace Cosmos\Collections\Exceptions;

/**
 * Collection Key Invalid Exception
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Exceptions
 */
class CollectionKeyInvalidException extends \Exception
{
    /**
     * Override
     */
    public function __construct($key)
    {
        parent::__construct('Key ' . $key . ' does not exist in collection.');
    }

}
