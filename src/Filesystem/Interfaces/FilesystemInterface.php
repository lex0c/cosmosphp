<?php
namespace Cosmos\Filesystem\Interfaces;

/**
 * Filesystem Interface
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Filesystem\Interfaces
 */
interface FilesystemInterface
{
    /**
     * Create a new.
     *
     * @param string $name
     * @param string $path
     * @param bool   $force
     *
     * @return bool
     *
     * @throws \RuntimeException
     */
    public function create(string $name, string $path, bool $force):bool;

    /**
     * Determine if exists.
     *
     * @param string $name
     * @param string $path
     *
     * @return bool
     */
    public function exists(string $name, string $path):bool;

    /**
     * Delete at a given path.
     *
     * @param string $name
     * @param string $path
     *
     * @return bool
     *
     * @throws \RuntimeException
     */
    public function delete(string $name, string $path):bool;

    /**
     * Copy to a new location.
     *
     * @param string $name
     * @param string $to
     * @param string $path
     *
     * @return bool
     *
     * @throws \RuntimeException
     */
    public function copy(string $name, string $to, string $path):bool;

    /**
     * Move to a new location.
     *
     * @param string $name
     * @param string $to
     * @param string $path
     *
     * @return bool
     *
     * @throws \RuntimeException
     */
    public function move(string $name, string $to, string $path):bool;

    /**
     * Look for something inside.
     *
     * @param string $name
     * @param string $search
     * @param string $path
     *
     * @return bool
     *
     * @throws \RuntimeException
     */
    public function searchInside(string $name, string $search, string $path):bool;

}
