<?php

/**
 * Cosmos Helpers
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 *
 */

use \Cosmos\Container\Container;
use \Cosmos\Utils\Slugger;

if (!function_exists('cosmos')) {
    /**
     * Get the container instance.
     *
     * @param string $namespace
     * @param array  $params
     * @param bool   $singleton
     *
     * @return mixed \DI\Container
     */
    function cosmos(string $namespace = null, array $params = [], bool $singleton = true)
    {
        if ($namespace != null) {
            return Container::make($namespace, $params, $singleton);
        }

        return Container::getInstance();
    }

}

if (!function_exists('vDump')) {
    /**
     * Displays debug about the data and ends the script.
     *
     * @param mixed $data
     * @param bool  $superDump
     *
     * @return void
     */
    function vDump($data, bool $superDump = true):void
    {
        $dump = cosmos('Cosmos\Debug\Debugger');
        $dump->varDump($data, $superDump);
        die(1);
    }
}

if (!function_exists('slug')) {
    /**
     * Replace spaces with dashes to format file names.
     *
     * @param string $phrase
     * @param bool   $inArray
     *
     * @return mixed
     */
    function slug(string $phrase, bool $inArray = false)
    {
        return Slugger::format($phrase, $inArray);
    }
}

