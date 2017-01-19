<?php

namespace Cosmos\Filesystem;

use \RuntimeException;
use \InvalidArgumentException;

/**
 * File Handler
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Filesystem
 */
abstract class AbstractFilesystem
{
	/**
     * Path to the file.
     * @var string
     */
    protected $path = '';

    /**
     * Format the path file.
     *
     * @param string $path
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected function pathFormat(string $path):string
    {
        if (is_dir($path)) {
            if (substr($path, -1) !== '/') {
                $path .= '/';
            }

            return str_ireplace('/', DIRECTORY_SEPARATOR, $path);
        }

        throw new RuntimeException("This path '{$path}' not a dir or not exists!");
    }

    /**
     * Change permissions for a file or directory.
     *
     * @param string $name
     * @param int    $mode
     * @param string $path
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function chmod(string $name, int $mode = 0755, string $path = ''):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);
        $ch   = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $name);

        if ((is_readable($ch)) || (is_dir($ch))) {
            return @chmod($ch, $mode);
        }

        throw new InvalidArgumentException('Arguments not valid!');
    }

}
