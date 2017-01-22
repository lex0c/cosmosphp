<?php
namespace Cosmos\Collections\Exceptions;

/**
 * Collection Callback Invalid Exception
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Exceptions
 */
class CollectionCallbackInvalidException extends \Exception
{
    /**
     * Handles exception for callback invalid.
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
