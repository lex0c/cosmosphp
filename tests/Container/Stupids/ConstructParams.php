<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 18/01/17
 * Time: 17:58
 */

namespace Tests\Container\Stupids;


class ConstructParams
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return 'Hello! ' . $this->name;
    }

}
