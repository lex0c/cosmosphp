<?php
namespace Test\Collections;

use \PHPUnit_Framework_TestCase as TestCase;
use \Tests\Collections\Stupids\StupidClass;
use \Cosmos\Collections\ArrayList;

class ArrayListTest extends TestCase
{
    /**
     * @var ArrayList
     */
    protected $list;

    /**
     * Stupid object for tests..
    */
    protected $obj;

    /**
     * Instance of objects.
     */
    public function setUp()
    {
        $this->list = new ArrayList();
        $this->obj  = new StupidClass();
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testAddElementsInList()
    {
        $this->assertTrue($this->list->add(12));
        $this->assertTrue($this->list->add('helloooo'));
        $this->assertTrue($this->list->add('15'));
        $this->assertTrue($this->list->add(11.23));
        $this->assertTrue($this->list->add($this->obj));

        return $this->list;
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedFailure
     */
    public function testFailureAddRepeatedElementsInList(ArrayList $list)
    {
        $this->assertFalse($list->add(12));
        $this->assertFalse($list->add('helloooo'));
        $this->assertFalse($list->add('15'));
        $this->assertFalse($list->add(11.23));
        //$this->asserttrue ($list->add($this->obj));

//        $this->assertThat($this->obj,
//            $this->logicalNot(
//                $this->equalTo($list->get(4))
//            )
//        );

    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testCountElementsInList(ArrayList $list)
    {
        $this->assertCount(5, $list->getAll());
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testAsCorrectKeysInList(ArrayList $list)
    {
        $this->assertArrayHasKey(0, $list->getAll());
        $this->assertArrayHasKey(1, $list->getAll());
        $this->assertArrayHasKey(2, $list->getAll());
        $this->assertArrayHasKey(3, $list->getAll());
        $this->assertArrayHasKey(4, $list->getAll());
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testContainsCorrectElementsInList(ArrayList $list)
    {
        $this->assertContains(12, $list->getAll());
        $this->assertContains('helloooo', $list->getAll());
        $this->assertContains('15', $list->getAll());
        $this->assertContains(11.23, $list->getAll());
        $this->assertInstanceOf('stdClass', $this->obj);
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testAddElementInSpecificPosition(ArrayList $list)
    {
        $this->assertTrue($list->addIn(1, 'world'));

        $this->assertCount(6, $list->getAll());

        $this->assertArrayHasKey(0, $list->getAll());
        $this->assertArrayHasKey(1, $list->getAll());
        $this->assertArrayHasKey(2, $list->getAll());
        $this->assertArrayHasKey(3, $list->getAll());
        $this->assertArrayHasKey(4, $list->getAll());
        $this->assertArrayHasKey(5, $list->getAll());

        $this->assertContains(12, $list->getAll());
        $this->assertContains('world', $list->getAll());
        $this->assertContains('helloooo', $list->getAll());
        $this->assertContains('15', $list->getAll());
        $this->assertContains(11.23, $list->getAll());
        $this->assertInstanceOf('stdClass', $this->obj);

    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testSetElementsInList(ArrayList $list)
    {
        $this->assertTrue($list->set(3, 155));
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedException \RuntimeException
     */
    public function testExceptionBySetElementsInListWhatKeyNotExists(ArrayList $list)
    {
        $list->set(9, 155);
    }

}
