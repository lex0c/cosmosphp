<?php
namespace Tests\Security\Encryption;

use \PHPUnit_Framework_TestCase as TestCase;
//use \Cosmos\Security\Encryption\HashMask;

class HashMaskTest extends TestCase
{
    /**
     * @test
     * @expectedSuccess
     */
    public function testCreateHashMask()
    {
        $value = hashMask('Hahahahah');
        $this->assertEquals('V1lvRkdTb0ZHYWho', $value);

        return $value;
    }

    /**
     * @test
     * @depends testCreateHashMask
     * @expectedSuccess
     */
    public function testRetrievingHashMaskValue(string $value)
    {
        $this->assertEquals('Hahahahah', hashMask($value, true));
    }

}
