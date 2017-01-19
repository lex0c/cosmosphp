<?php

namespace Tests\Filesystem;

use \PHPUnit_Framework_TestCase as TestCase;
use \Cosmos\Filesystem\FileHandler;

class FileHandlerTest extends TestCase
{
    /**
     * @var FileHandler
     */
    protected $handler = null;

    /**
     * Paths for tests with files.
     *
     * @var string
    */
    protected $stupidClassPath = __DIR__ . '/stupids/';
    protected $stupidCustomPath = __DIR__ . '/stupids/somethings/';

    /**
     * Inject a the handler.
     * @var FileHandler
     */
    public function setUp()
    {
        $this->handler = cosmos('\Cosmos\Filesystem\FileHandler', [
            'path' => $this->stupidClassPath
        ]);
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCreateFileNotFinalBar()
    {
        $handler = cosmos('\Cosmos\Filesystem\FileHandler', [
            'path' => $this->stupidClassPath
        ]);
    }

    /**
     * @test
     *
     * If the path is not a directory or not exists a
     * runtime exception is thrown launched.
     *
     * @expectedException \RuntimeException
     */
    public function testExceptionByDirNotExists()
    {
        new FileHandler((__DIR__) . '/qdsgsb/');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCreateFile()
    {
        $this->handler->delete('hello.txt');
        $this->assertTrue($this->handler->create('hello.txt'));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCreateFileWithCustomPath()
    {
        $this->handler->delete('things.txt', $this->stupidCustomPath);
        $this->assertTrue($this->handler->create('things.txt',
            $this->stupidCustomPath));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCreateFileNotForce()
    {
        $this->handler->delete('hello2.txt', $this->stupidClassPath);
        $this->assertTrue($this->handler->create('hello2.txt',
            $this->stupidClassPath, false));
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByRecreateFileExisting()
    {
        $this->handler->create('hello.txt');
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByCreateFileInInvalidCustomPath()
    {
        $this->handler->create('some.txt', (__DIR__) . '/ernbb/');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCheckFileExists()
    {
        $this->assertTrue($this->handler->exists('hello.txt'));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCheckFileExistsWithCustomPath()
    {
        $this->assertTrue($this->handler->exists('things.txt',
            $this->stupidCustomPath));
    }

    /**
     * @test
     * @expectedFailue
     */
    public function testCheckFileNotExists()
    {
        $this->assertFalse($this->handler->exists('smgtebnnu.txt'));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testReadFile()
    {
        $this->assertEquals('alalah', $this->handler->read('readable.txt'));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testReadFileWithCustomPath()
    {
        $this->assertEquals('alalah',
            $this->handler->read('readable.txt', $this->stupidCustomPath));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testReadFileNotForce()
    {
        $this->assertEquals('alalah', $this->handler->read('readable.txt', false));
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByReadFileNotExisting()
    {
        $this->handler->read('aodjfvcde.txt');
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByInvalidCustomPathInRead()
    {
        $this->handler->read('readable.txt', (__DIR__) . '/filesdf/');
    }

    //

}
