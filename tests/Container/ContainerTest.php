<?php

namespace Test\Container;

use \PHPUnit_Framework_TestCase as TestCase;
use \Cosmos\Container\Container;

class ContainerTest extends TestCase
{
    /**
     * @test
     * @expectedSuccess
     */
    public function testIfContainerGetCorrectClassInstance()
    {
        $userManager = app('Tests\Container\Stupids\UserManager');
        $this->assertTrue($userManager instanceof \Tests\Container\Stupids\UserManager);
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testGetContainerInstance()
    {
        $this->assertTrue(app() instanceof \DI\ContainerBuilder);
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testGetMessageByDependencyInjection()
    {
        $userManager = app('Tests\Container\Stupids\UserManager');
        $return = $userManager->register('leo@castro.com', '');

        $this->assertEquals($return, 'leo@castro.com: Hello and welcome!');
    }

    /**
     * @test
     * @expectedException \DI\NotFoundException
     */
    public function testExceptionInIncorrectClassNamespace()
    {
        app('UserManager');
    }

    /**
     * @test
     * @expectedException \ReflectionException
     */
    public function testExceptionInIncorrectClassNamespaceOnInjection()
    {
        app('Tests\Container\Stupids\StupidClass');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testSetParamsInClassConstruct()
    {
        $cp = app('Tests\Container\Stupids\ConstructParams', [
            'name' => 'Léo Castro'
        ]);

        $this->assertEquals($cp->getName(), 'Hello! Léo Castro');
    }

    /**
     * @test
     * @expectedException \DI\Definition\Exception\DefinitionException
     */
    public function testExceptionInSetIncorrectParamsInClassConstruct()
    {
        app('Tests\Container\Stupids\ConstructParams', [
            'username' => 'Léo Castro'
        ]);
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testGetSimpleClassInstance()
    {
        $userManager = Container::get('Tests\Container\Stupids\UserManager');
        $this->assertTrue($userManager instanceof \Tests\Container\Stupids\UserManager);
    }

}
