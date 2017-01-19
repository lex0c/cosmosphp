<?php

use Cosmos\Container\Container;

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

if (!function_exists('dd')) {
    /**
     * Displays debug about the data and ends the script.
     *
     * @param mixed $data
     * @param bool  $superDump
     *
     * @return void
     */
    function dd($data, bool $superDump = true):void
    {
        $dump = cosmos('Cosmos\Debug\Debugger');
        $dump->varDump($data, $superDump);
        die(1);
    }
}

