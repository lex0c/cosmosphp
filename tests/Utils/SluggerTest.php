<?php
namespace Tests\Utils;

use \PHPUnit_Framework_TestCase as TestCase;

class SluggerTest extends TestCase
{
    /**
     * @test
     * @expectedSuccess
    */
    public function testGetPhraseFormatted()
    {
        $phrase = 'Hello World! ({|||}) #happy';
        $this->assertEquals('hello-world-happy', slug($phrase));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testGetSlugInArray()
    {
        $phrase = 'Hello World!';
        $this->assertEquals('hello-world', slug($phrase, true)[0]);
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testGetFilenameAndExtensionInArray()
    {
        $phrase = 'Hello World!.jpg';
        $this->assertEquals('hello-world', slug($phrase, true)[0]);
        $this->assertEquals('.jpg', slug($phrase, true)[1]);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionByEmptyParams()
    {
        slug('');
    }

}
