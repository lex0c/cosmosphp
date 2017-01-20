<?php
namespace Cosmos\Collections\Exceptions;

/**
 * Collection Key In Use Exception
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Exceptions
 */
class CollectionKeyInUseException extends \Exception
{
    public function __construct($key)
    {
        parent::__construct('Key ' . $key . ' already exists in collection.');
    }

}
