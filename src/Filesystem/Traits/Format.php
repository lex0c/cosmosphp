<?php
namespace Cosmos\Filesystem\Traits;

/**
 * File Handler
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Filesystem\Traits
 */
trait Format
{
    /**
     * Format the path file.
     *
     * @param string $path
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected function pathFormat(string $path):string
    {
        if (is_dir($path)) {

            if (substr($path, -1) !== '/') {
                $path .= '/';
            }

            return str_ireplace('/', DIRECTORY_SEPARATOR, $path);
        }

        throw new \RuntimeException("This path '{$path}' not a dir or not exists!");
    }
}
