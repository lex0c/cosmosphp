<?php
namespace Cosmos\Collections\Exceptions;

/**
 * Null Pointer Exception
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Exceptions
 */
class NullPointerException extends \RuntimeException
{
    /**
     * Handles exception for invalid or non-existent pointer.
     *
     * @param string    $message
     * @param    int    $code
     * @param \Exception $previous
    */
    public function __construct(string $message = '', int $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
