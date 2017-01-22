<?php
namespace Cosmos\Collections\Exceptions;

/**
 * Index Not Found Exception
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Exceptions
 */
class IndexNotFoundException extends \RuntimeException
{
    /**
     * Handles exception for index not found.
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
