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

    /**
     * @test
     * @expectedSuccess
     */
    public function testWriteFile()
    {
        $data = 'Olaola';
        $this->assertTrue($this->handler->write('writable.txt', $data));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testWriteFileWithCustomPath()
    {
        $data = 'printnoblaa';
        $this->assertTrue($this->handler->write('writable.txt', $data,
            $this->stupidCustomPath));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testWriteFileNotForce()
    {
        $data = date('Ymd');
        $this->assertTrue($this->handler->write('writable.txt', $data, false));
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByWriteFileNotExisting()
    {
        $data = 'lol';
        $this->handler->write('aodjfvcde.txt', $data);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByInvalidCustomPathInWrite()
    {
        $data = 'goool';
        $this->handler->write('writable.txt', $data,
            (__DIR__) . '/filesdf/');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testAppendFile()
    {
        $data = 'Two do u.';
        $this->assertTrue($this->handler->append('writable.txt', $data));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testAppendFileWithCustomPath()
    {
        $data = 'moremoremore';
        $this->assertTrue($this->handler->append('writable.txt', $data,
            $this->stupidCustomPath));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testAppendFileNotForce()
    {
        $data = 'abcdef';
        $this->assertTrue($this->handler->append('writable.txt', $data, false));
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByAppendFileNotExisting()
    {
        $data = 'abcdef';
        $this->handler->append('aodjfvcde.txt', $data);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByInvalidCustomPathInAppend()
    {
        $data = 'abcdef';
        $this->handler->append('writable.txt', $data,
            (__DIR__) . '/filesdf/');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCopyFile()
    {
        $this->assertTrue($this->handler->copy(
            'stupidfile.txt', 'somethings/backup.txt'));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCopyFileWithCustomPath()
    {
        $this->assertTrue($this->handler->copy(
            'stupidfile.txt', 'backup.txt', $this->stupidClassPath));
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByCopyFileNotExists()
    {
        $this->handler->copy('rderhe.txt', 'somethings/backup.txt');
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByCopyFileInInvalidPath()
    {
        $this->handler->copy('appendable.txt', 'somen/backup.txt');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testMoveFile()
    {
        $this->assertTrue($this->handler->move('mobe.txt', $this->stupidCustomPath));
    }

    /**
     * @test
     * @depends testMoveFile
     * @expectedSuccess
     */
    public function testMoveFileWithCustomPath()
    {
        $this->assertTrue($this->handler->move(
            'mobe.txt', $this->stupidClassPath, $this->stupidCustomPath));
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByMoveFileNotExists()
    {
        $this->handler->move('rderhe.txt', $this->stupidCustomPath);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByMoveFileInInvalidPath()
    {
        $this->handler->move('mobe.txt', 'somen/backup.txt');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testDeleteFile()
    {
        $this->handler->create('x.txt');
        $this->assertTrue($this->handler->delete('x.txt'));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testDeleteFileWithCustomPath()
    {
        $this->handler->create('hello2.txt', $this->stupidCustomPath);
        $this->assertTrue($this->handler->delete('hello2.txt',
            $this->stupidCustomPath));

        $this->assertTrue($this->handler->delete('things.txt',
            $this->stupidCustomPath));
        $this->handler->create('things.txt', $this->stupidCustomPath);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByDeleteFileNotExists()
    {
        $this->handler->delete('rderhe.txt', $this->stupidCustomPath);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionByDeleteFileInInvalidPath()
    {
        $this->handler->delete('rderhe.txt', 'somen/backup.txt');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testGetInfosOfFile()
    {
        $fileInfo = $this->handler->info('readable.txt');

        $this->assertCount(10, $fileInfo);
        $this->assertArrayHasKey('pathname', $fileInfo);
        $this->assertArrayHasKey('basename', $fileInfo);
        $this->assertArrayHasKey('dirname', $fileInfo);
        $this->assertArrayHasKey('extension', $fileInfo);
        $this->assertArrayHasKey('mimetype', $fileInfo);
        $this->assertArrayHasKey('filetype', $fileInfo);
        $this->assertArrayHasKey('lastmodified', $fileInfo);
        $this->assertArrayHasKey('lastaccess', $fileInfo);
        $this->assertArrayHasKey('owner', $fileInfo);
        $this->assertArrayHasKey('group', $fileInfo);
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testGetInfosOfFileWithCustomPath()
    {
        $fileInfo = $this->handler->info(
            'readable.txt', $this->stupidCustomPath);

        $this->assertCount(10, $fileInfo);
        $this->assertArrayHasKey('pathname', $fileInfo);
        $this->assertArrayHasKey('basename', $fileInfo);
        $this->assertArrayHasKey('dirname', $fileInfo);
        $this->assertArrayHasKey('extension', $fileInfo);
        $this->assertArrayHasKey('mimetype', $fileInfo);
        $this->assertArrayHasKey('filetype', $fileInfo);
        $this->assertArrayHasKey('lastmodified', $fileInfo);
        $this->assertArrayHasKey('lastaccess', $fileInfo);
        $this->assertArrayHasKey('owner', $fileInfo);
        $this->assertArrayHasKey('group', $fileInfo);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionInInfoByFileNotExists()
    {
        $this->handler->info('dgnsoin.txt');
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testExceptionInInfoByFileNotExistsInInvalidPath()
    {
        $this->handler->info('readable.txt', 'somen/backup.txt');
    }

    //

}
