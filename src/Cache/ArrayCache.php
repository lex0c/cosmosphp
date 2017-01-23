<?php
namespace Cosmos\Cache;

use \Cosmos\Cache\Interfaces\StorageInterface;
use \Cosmos\Cache\Exceptions\CacheNotFoundException;

/**
 * Array Cache
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Cache
 */
class ArrayCache implements StorageInterface
{
    /**
     * Cache storage.
     *
     * @var array
     */
    protected $storage = [];

    /**
     * Key prefix.
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Constructor of ArrayCache.
     *
     * @param string $prefix
     */
    public function __construct(string $prefix = '')
    {
        if (!empty($prefix)) {
            $this->prefix = $prefix;
        }
    }

    /**
     * Create an item in the cache.
     *
     * @param string $key
     * @param array  $data
     *
     * @return bool
     */
    public function guard(string $key, array $data):bool
    {
        if(!$this->keyExists($key)) {
            $this->storage[$this->prefix.$key] = [
                'token' => substr(base64_encode(uniqid(mt_rand(), true)), 2, 23),
                'data'  => $data,
                'created_at' => date("D M j G:i:s T Y"),
                'updated_at' => date("D M j G:i:s T Y")
            ];

            return true;
        }

        return false;
    }

    /**
     * Edit an item in the cache.
     *
     * @param string $key
     * @param array  $data
     *
     * @return bool
     *
     * @throws CacheNotFoundException
     */
    public function edit(string $key, array $data):bool
    {
        if($this->keyExists($key)) {
            $this->storage[$key]['data'] = $data;
            $this->storage[$key]['updated_at'] = date("D M j G:i:s T Y");
            return true;
        }

        throw new CacheNotFoundException("This key '{$key}' not exists in this cache instance.");
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param string $key
     *
     * @return array
     */
    public function get(string $key):array
    {
        if($this->keyExists($key)) {
            return $this->storage[$key]['data'];
        }

        return [];
    }

    /**
     * Retrieve an info from the cache by key.
     *
     * @param string $key
     *
     * @return array
     */
    public function getInfo(string $key):array
    {
        if($this->keyExists($key)) {
            $data = $this->storage[$key];
            return [
                'key' => $this->prefix.$key,
                'token'  => $data['token'],
                'length' => sizeof($data['data']),
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at']
            ];
        }

        return [];
    }

    /**
     * Return all items from the cache.
     *
     * @return array
     */
    public function getAll():array
    {
        return $this->storage;
    }

    /**
     * Remove item from the cache.
     *
     * @param string $key
     *
     * @return bool
     */
    public function destroy(string $key):bool
    {
        if($this->keyExists($key)) {
            unset($this->storage[$key]);
            return true;
        }

        throw new CacheNotFoundException("This key '{$key}' not exists in this cache instance.");
    }

    /**
     * Remove all items from the cache.
     *
     * @return void
     */
    public function removeAll()
    {
        $this->storage = [];
    }

    /**
     * Check the key exists in array cache.
     *
     * @param string $key
     *
     * @return bool
     */
    public function keyExists(string $key):bool
    {
        if(array_key_exists($key, $this->storage)
            || (array_key_exists($this->prefix.$key, $this->storage))) {
            return true;
        }

        return false;
    }

    /**
     * Return the prefix of key.
     *
     * @return string
     */
    public function getPrefix():string
    {
        return $this->prefix;
    }

    /**
     * Set the prefix of keys.
     *
     * @param string $prefix
     *
     * @return ArrayCache
     */
    public function setPrefix(string $prefix):ArrayCache
    {
        $this->prefix = $prefix;
        return $this;
    }

}
