<?php
namespace Cosmos\Filesystem;

//use \DirectoryIterator;
//use \RecursiveDirectoryIterator;
use \Cosmos\Filesystem\Interfaces\FilesystemInterface;
use \Cosmos\Filesystem\Exceptions\FolderNotFoundException;

/**
 * Folder Handler
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Filesystem
 */
class FolderHandler extends AbstractFilesystem implements FilesystemInterface
{
    /**
     * Inject a the handler.
     * @var FolderHandler
     */
    protected $folderHandler = null;

    /**
     * Create a new FileHandler instance.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->setPath($path);
    }

    /**
     * Create a new folder.
     *
     * @param string $name
     * @param string $path
     * @param bool $force
     * @return bool
     * 
     * @throws \RuntimeException
     */
    public function create(string $name, string $path, bool $force):bool
    {}

    /**
     * Determine if exists.
     *
     * @param string $name
     * @param string $path
     * @return bool
     */
    public function exists(string $name, string $path):bool
    {}

    /**
     * Delete at a given path.
     *
     * @param string $name
     * @param string $path
     * @return bool
     * 
     * @throws \RuntimeException
     */
    public function delete(string $name, string $path):bool
    {}

    /**
     * Copy to a new location.
     *
     * @param string $name
     * @param string $to
     * @param string $path
     * @return bool
     * 
     * @throws \RuntimeException
     */
    public function copy(string $name, string $to, string $path):bool
    {}

    /**
     * Move to a new location.
     *
     * @param string $name
     * @param string $to
     * @param string $path
     * @return bool
     * 
     * @throws \RuntimeException
     */
    public function move(string $name, string $to, string $path):bool
    {}

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
    public function searchInside(string $name, string $search, string $path):bool
    {}

    /**
     * Retrieve the path.
     *
     * @return string
     */
    public function getPath():string
    {
        return $this->path;
    }

    /**
     * Set a new path.
     *
     * @param string $path
     *
     * @return FolderHandler
     */
    public function setPath(string $path):FolderHandler
    {
        $this->path = $this->pathFormat($path);
        return $this;
    }

}
