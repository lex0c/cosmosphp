<?php

namespace Cosmos\Container;

use \DI\ContainerBuilder;
use \DI\Scope;

final class Container
{
    /**
     * Singleton Pattern
     * @var \DI\Container
     */
    private static $instance = null;

    /**
     * Class for static access, only.
     */
    private function __construct()
    {}

    /**
     * Get a simple class instance with injections.
     *
     * @param string $namespace
     *
     * @return mixed
     */
    public static function get(string $namespace)
    {
        return self::getInstance()->build()
            ->get($namespace);
    }

    /**
     * Create a new class instance, with optional parameters.
     *
     * @param string  $namespace
     * @param array   $params
     * @param boolean $singleton
     *
     * @return mixed
     */
    public static function make(string $namespace, array $params = [], bool $singleton = true)
    {
        $builder = self::getInstance();

        if(!$singleton)
            $builder->addDefinitions([
                $namespace => \DI\object()->scope(Scope::PROTOTYPE())
            ]);

        $build = $builder->build();
        return $build->make($namespace, $params);
    }

    /**
     * Get the container instance.
     *
     * @return \DI\ContainerBuilder
     */
    public static function getInstance():ContainerBuilder
    {
        if(is_null(self::$instance)) {
            self::$instance = new ContainerBuilder();
        }

        return self::$instance;
    }

}
