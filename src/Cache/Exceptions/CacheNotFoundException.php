<?php
namespace Cosmos\Cache\Exceptions;

/**
 * Cache Not Found Exception
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Cache\Exceptions
 */
class CacheNotFoundException extends \RuntimeException
{
    /**
     * Handles exception for cache not found.
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
