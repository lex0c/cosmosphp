<?php
namespace Cosmos\Cache\Interfaces;

/**
 * Storage Interface
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Cache\Interfaces
 */
interface StorageInterface
{
    /**
     * Create an item in the storage.
     *
     * @param string $key
     * @param array  $data
     *
     * @return bool
     */
    public function guard(string $key, array $data):bool;

    /**
     * Edit an item in the storage.
     *
     * @param string $key
     * @param array  $data
     *
     * @return bool
     */
    public function edit(string $key, array $data):bool;

    /**
     * Retrieve an item from the storage by key.
     *
     * @param string $key
     *
     * @return array
     */
    public function get(string $key):array;

    /**
     * Return all items from the storage.
     *
     * @return array
     */
    public function getAll():array;

    /**
     * Remove item from the storage.
     *
     * @param string $key
     *
     * @return bool
     */
    public function destroy(string $key):bool;

    /**
     * Remove all item from storage.
     *
     * @return void
     */
    public function removeAll();

    /**
     * Get the key prefix.
     *
     * @return string
     */
    public function getPrefix():string;

}
