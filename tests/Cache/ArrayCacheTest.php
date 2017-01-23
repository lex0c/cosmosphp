<?php
namespace Test\Cache;

use \PHPUnit_Framework_TestCase as TestCase;
use \Cosmos\Cache\ArrayCache;

class ArrayCacheTest extends TestCase
{
    /**
     * Cache object for tests..
     */
    protected $cache;

    /**
     * Instance of objects.
     */
    public function setUp()
    {
        $this->cache = new ArrayCache();
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCreateCache()
    {
        $this->assertTrue($this->cache->guard('superDay', [
            'dom' => 'domingo',
            'seg' => 'segunda',
            'ter' => 'terca',
            'qua' => 'quarta',
            'qui' => 'quinta',
            'sex' => 'sexta',
            'sab' => 'sabado'
        ]));

        return $this->cache;
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedSuccess
     */
    public function testCreateCacheWithExistingKey(ArrayCache $cache)
    {
        $this->assertFalse($cache->guard('superDay', [
            'hello' => 'blablabla'
        ]));
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedSuccess
     */
    public function testCheckIfSpecificKeyExistsInCache(ArrayCache $cache)
    {
        $this->assertArrayHasKey('superDay', $cache->getAll());
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedSuccess
     */
    public function testCheckIfSpecificsKeysExistsInInfoCache(ArrayCache $cache)
    {
        $this->assertArrayHasKey('token',  $cache->getInfo('superDay'));
        $this->assertArrayHasKey('length', $cache->getInfo('superDay'));
        $this->assertArrayHasKey('created_at', $cache->getInfo('superDay'));
        $this->assertArrayHasKey('updated_at', $cache->getInfo('superDay'));

        //Failure
        $this->assertEmpty($cache->getInfo('data'));
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedSuccess
     */
    public function testCheckIfSpecificsKeyExistsInArrayData(ArrayCache $cache)
    {
        $this->assertArrayHasKey('dom', $cache->get('superDay'));
        $this->assertArrayHasKey('seg', $cache->get('superDay'));
        $this->assertArrayHasKey('ter', $cache->get('superDay'));
        $this->assertArrayHasKey('qua', $cache->get('superDay'));
        $this->assertArrayHasKey('qui', $cache->get('superDay'));
        $this->assertArrayHasKey('sex', $cache->get('superDay'));
        $this->assertArrayHasKey('sab', $cache->get('superDay'));

        //Failure
        $this->assertEmpty($cache->get('fer'));
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedSuccess
     */
    public function testCheckValuesExistsInInfoCache(ArrayCache $cache)
    {
        $this->assertNotEmpty($cache->getInfo('superDay')['token']);
        $this->assertNotEmpty($cache->getInfo('superDay')['length']);

        $this->assertEquals(7, $cache->getInfo('superDay')['length']);
        $this->assertEquals($cache->getInfo('superDay')['created_at'],
            $cache->getInfo('superDay')['updated_at']);
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedSuccess
     */
    public function testCheckIfSpecificsValuesExistsInCacheData(ArrayCache $cache)
    {
        $this->assertContains('domingo', $cache->get('superDay'));
        $this->assertContains('segunda', $cache->get('superDay'));
        $this->assertContains('terca',   $cache->get('superDay'));
        $this->assertContains('quarta',  $cache->get('superDay'));
        $this->assertContains('quinta',  $cache->get('superDay'));
        $this->assertContains('sexta',   $cache->get('superDay'));
        $this->assertContains('sabado',  $cache->get('superDay'));
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedSuccess
     */
    public function testEditValueInCacheData(ArrayCache $cache)
    {
        $this->assertTrue($cache->edit('superDay', [
            'dom' => 'domingo',
            'seg' => 'segunda',
            'ter' => 'terca',
            'qua' => 'quarta',
            'qui' => 'quinta',
            'sex' => 'sexta',
            'sab' => 'sabado',
            'fer' => 'feriado'
        ]));

        $this->assertArrayHasKey('fer',  $cache->get('superDay'));
        $this->assertContains('feriado', $cache->get('superDay'));
        $this->assertEquals(8, $cache->getInfo('superDay')['length']);

        return $this->cache;
    }

//    /**
//     * @test
//     * @depends testEditValueInCacheData
//     * @expectedSuccess
//     */
//    public function testDateTimeDifferentPosEdit(ArrayCache $cache)
//    {
//        $this->assertNotEquals($cache->getInfo('superDay')['updated_at'],
//            $cache->getInfo('superDay')['created_at']);
//    }

    /**
     * @test
     * @depends testEditValueInCacheData
     * @expectedException \RuntimeException
    */
    public function testExceptionByEditCacheInKeyNonexistent(ArrayCache $cache)
    {
        $cache->edit('super-day', []);
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedSuccess
     */
    public function testDeleteSpecificCacheByKey(ArrayCache $cache)
    {
        $this->assertTrue($cache->destroy('superDay'));
        $this->assertArrayNotHasKey('superDay',  $cache->getAll());
    }

    /**
     * @test
     * @depends testCreateCache
     * @expectedException \RuntimeException
     */
    public function testExceptionByDestroyCacheInKeyNonexistent(ArrayCache $cache)
    {
        $cache->destroy('super-day');
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testCreateMoreCache()
    {
        $this->assertTrue($this->cache->guard('superDay', [
            'dom' => 'domingo',
            'seg' => 'segunda',
            'ter' => 'terca',
            'qua' => 'quarta',
            'qui' => 'quinta',
            'sex' => 'sexta',
            'sab' => 'sabado'
        ]));

        $this->assertTrue($this->cache->guard('numbers', [
            232, 63, 34634, 235, 54, 53663, 235435
        ]));

        $this->assertTrue($this->cache->guard('texts', [
            'Hello World!'
        ]));

        $this->assertArrayHasKey('superDay', $this->cache->getAll());
        $this->assertArrayHasKey('numbers',  $this->cache->getAll());
        $this->assertArrayHasKey('texts',    $this->cache->getAll());

        return $this->cache;
    }

}
