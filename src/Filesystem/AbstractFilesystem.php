<?php
namespace Cosmos\Filesystem;

use Cosmos\Filesystem\Traits\Format;

/**
 * File Handler
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Filesystem
 */
abstract class AbstractFilesystem
{
    use Format;

	/**
     * Path to the file.
     * @var string
     */
    protected $path = '';

    /**
     * Change permissions for a file or directory.
     *
     * @param string $name
     * @param int    $mode
     * @param string $path
     *
     * @return bool
     *
     * @throws \InvalidArgumentException
     */
    public function chmod(string $name, int $mode = 0755, string $path = ''):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);
        $ch   = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $name);

        if ((is_readable($ch)) || (is_dir($ch))) {
            return @chmod($ch, $mode);
        }

        throw new \InvalidArgumentException('Arguments not valid!');
    }

}
