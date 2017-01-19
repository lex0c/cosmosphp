<?php
namespace Cosmos\Filesystem;

//use \FilesystemIterator;
//use \Symfony\Component\Finder\Finder;
use \Cosmos\Filesystem\Interfaces\FilesystemInterface;
use \Cosmos\Filesystem\Exceptions\FileNotFoundException;

/**
 * File Handler
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Filesystem
 */
class FileHandler extends AbstractFilesystem implements FilesystemInterface
{
    /**
     * Inject a the handler.
     * @var FileHandler
     */
    protected $fileHandler = null;

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
     * Check a file exists.
     *
     * @param string $filename
     * @param string $path
     *
     * @return bool
     */
    public function exists(string $filename, string $path = ''):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);
        return is_readable($path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename));
    }

    /**
     * Create a file.
     *
     * @param string $filename
     * @param string $path
     * @param bool   $force
     *
     * @return bool
     */
    public function create(string $filename, string $path = '', bool $force = true):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);
        $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);

        if ((!$this->exists($filename, $path)) && ($force)) {
            try {
                $handle = fopen($file, 'wb');
            } finally {
                fclose($handle);
                return true;
            }
        } elseif ((!$this->exists($filename, $path)) && (!$force)) {
            file_put_contents($file, '', LOCK_EX);
            return true;
        }

        throw new \RuntimeException("This file '{$filename}' exists in '{$path}'.");
    }
    
	/**
     * Get the contents of file.
     *
     * @param string $filename
     * @param string $path
     * @param bool   $force
     *
     * @return string
     * 
     * @throws FileNotFoundException
     */
    public function read(string $filename, string $path = '', bool $force = true):string
    {
        $contents = '';
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);
        $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);
        
        if (($this->exists($filename, $path)) && ($force) && (is_readable($file))) {
            $handle = fopen($file, 'rb');
            try {
                if (flock($handle, LOCK_SH)) {
                    clearstatcache(true, $file);
                    $contents = fread($handle, $this->size($filename));
                    flock($handle, LOCK_UN);

                }
            } finally {
                fclose($handle);
            }

        } elseif (($this->exists($filename, $path)) && (!$force) && (is_readable($file))) {
            $contents = file_get_contents($file);
        } else {
            throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
        }

        return $contents;
    }

    /**
     * Write the contents of file.
     *
     * @param string $filename
     * @param string $path
     * @param string $content
     * @param bool $force
     *
     * @return bool
     * 
     * @throws FileNotFoundException
     */
    public function write(string $filename, string $content, string $path = '', bool $force = true):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);
        $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);

        if (($this->exists($filename, $path)) && ($force) && (is_readable($file))) {
            $handle = fopen($file, 'wb');
            try {
                if (flock($handle, LOCK_EX)) {
                    fwrite($handle, $content);
                    flock($handle, LOCK_UN);
                }
            } finally {
                fclose($handle);
                return true;
            }

        } elseif (($this->exists($filename, $path)) && (!$force) && (is_readable($file))) {
            file_put_contents($file, $content, LOCK_EX);
            return true;
        }

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Append to a file.
     *
     * @param string $filename
     * @param string $content
     * @param string $path
     * @param bool   $force
     *
     * @return bool
     *
     * @throws FileNotFoundException
     */
    public function append(string $filename, string $content, string $path = '', bool $force = true):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);
        $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);

        if (($this->exists($filename, $path)) && ($force) && (is_readable($file))) {
            $content = "\r\n" . $content;
            $handle  = fopen($file, 'ab');

            try {
                if (flock($handle, LOCK_EX)) {
                    fwrite($handle, $content);
                    flock($handle, LOCK_UN);
                }
            } finally {
                fclose($handle);
                return true;
            }

        } elseif (($this->exists($filename, $path)) && (!$force) && (is_readable($file))) {
            file_put_contents($file, $content, FILE_APPEND);
            return true;
        }

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Copy a file to a new location.
     *
     * @param string $filename
     * @param string $to
     * @param string $path
     *
     * @return bool
     * 
     * @throws FileNotFoundException
     */
    public function copy(string $filename, string $to, string $path = ''):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if ($this->exists($filename, $path)) {
            $from = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);

            if (strpos($to, '/')) {
                $file = substr((strrchr($to, '/')), (strrchr($to, '/') + 1));
                $subPath = trim(str_ireplace($file, '', $to));

                $to = $this->pathFormat($path . $subPath) . $file;

            } else {
                $to = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $to);
            }

            return copy($from, $to);
        }

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Copy content external of url to a file.
     *
     * @param string $url
     * @param string $to
     *
     * @return bool
     * 
     * @throws FileNotFoundException
     */
    public function copyUrlContent(string $url, string $to):bool
    {}

    /**
     * Move a file to a new location.
     *
     * @param string $filename
     * @param string $to
     * @param string $path
     *
     * @return bool
     * 
     * @throws FileNotFoundException
     */
    public function move(string $filename, string $to, string $path = ''):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if ($this->exists($filename, $path)) {
            $from = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);
            $to = $this->pathFormat($to) . $filename;

            return rename($from, $to);
        }

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Delete the file.
     *
     * @param string $filename
     * @param string $path
     *
     * @return bool
     * 
     * @return FileNotFoundException
     */
    public function delete(string $filename, string $path = ''):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if ($this->exists($filename, $path)) {
            $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);
            return unlink($file);
        }

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Get the file size.
     *
     * @param string $filename
     * @param string $path
     *
     * @return int
     * 
     * @throws FileNotFoundException
     */
    public function size(string $filename, string $path = ''):int
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if($this->exists($filename, $path)):
            $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);

            return filesize($file);
        endif;

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Returns the permissions of the file.
     *
     * @param string $filename
     * @param string $path
     *
     * @return string
     * 
     * @throws FileNotFoundException
     */
    public function perms(string $filename, string $path = ''):string
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if($this->exists($filename, $path)):
            $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);
            
            $perms = substr(sprintf('%o', fileperms($path)), -4);       
            return (is_bool($perms)) ? '' : $perms;
        endif;

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Get the file infos.
     *
     * @param string $filename
     * @param string $path
     *
     * @return array
     * 
     * @throws FileNotFoundException
     */
    public function info(string $filename, string $path = ''):array
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if ($this->exists($filename, $path)) {
            $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);

            return [
                'pathname' => pathinfo($path, PATHINFO_FILENAME),
                'basename' => pathinfo($path, PATHINFO_BASENAME),
                'dirname' => pathinfo($path, PATHINFO_DIRNAME),
                'extension' => pathinfo($path, PATHINFO_EXTENSION),
                'mimetype' => finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path),
                'filetype' => filetype($path),
                'lastmodified' => filemtime($path),
                'lastaccess' => fileatime($path),
                'owner' => fileowner($path),
                'group' => filegroup($path)
            ];
        }

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Get an array of all files in a directory.
     *
     * @param string $directory
     * @param string $path
     *
     * @return array
     */
    public function allFiles(string $directory, string $path = ''):array
    {}

    /**
     * Get content a file in a array.
     *
     * @param string $filename
     * @param string $path
     *
     * @return array
     */
    public function inArray(string $filename, string $path = ''):array
    {}

    /**
     * Compare if on one file content is equals another file.
     *
     * @param string $filename
     * @param string $fileComparable
     * @param string $path
     *
     * @return bool
     *
     * @throws FileNotFoundException
     */
    public function isEquals(string $filename, string $fileComparable, string $path = ''):bool
    {}

    /**
     * Determine if the given path is writable.
     *
     * @param string $filename
     * @param string $path
     *
     * @return bool
     *
     * @throws FileNotFoundException
     */
    public function isWritable(string $filename, string $path = ''):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if ($this->exists($filename, $path)) {
            $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);
            return is_writable($file);
        }

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Returns true if the File is executable.
     *
     * @param string $filename
     * @param string $path
     *
     * @return bool
     *
     * @throws FileNotFoundException
     */
    public function isExecutable(string $filename, string $path = ''):bool
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if ($this->exists($filename, $path)) {
            $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);
            return is_executable($file);
        }

        throw new FileNotFoundException("File '{$filename}' not exists in '{$path}'.");
    }

    /**
     * Look for something inside a file.
     *
     * @param string $filename
     * @param string $search
     * @param string $path
     *
     * @return bool
     *
     * @throws FileNotFoundException
     */
    public function searchInside(string $filename, string $search, string $path = ''):bool
    {}

    /**
     * Clear PHP internal stat cache.
     *
     * @param string $filename
     * @param string $path
     *
     * @return void
     */
    public function clearStatCache(string $filename = '',  string $path = ''):void
    {
        $path = (empty($path)) ? $this->path : $this->pathFormat($path);

        if (($this->exists($filename, $path)) && (!empty($filename))) {
            $file = $path . str_ireplace('/', DIRECTORY_SEPARATOR, $filename);
            clearstatcache(true, $file);
        }

        clearstatcache();
    }

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
     * @return FileHandler
     */
    public function setPath(string $path):FileHandler
    {
        $this->path = $this->pathFormat($path);
        return $this;
    }

}
