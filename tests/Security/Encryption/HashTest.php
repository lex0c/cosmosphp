<?php
namespace Tests\Security\Encryption;

use \PHPUnit_Framework_TestCase as TestCase;
//use \Cosmos\Security\Encryption\Hash;

class HashTest extends TestCase
{
    /**
     * @test
     * @expectedSuccess
     */
    public function testGenerateHash()
    {
        $hash = hashCrypt('Uhuuu!');

        if ((is_string($hash)) && (strlen($hash) == 80)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        return $hash;
    }

    /**
     * @test
     * @depends testGenerateHash
     * @expectedSuccess
     */
    public function testCompareHash(string $hash)
    {
        $this->assertTrue(hashCrypt('Uhuuu!', $hash));

        // Failures
        $this->assertFalse(hashCrypt('Uhuuu', $hash));
        $this->assertFalse(hashCrypt('uhuuu!', $hash));
    }

}
