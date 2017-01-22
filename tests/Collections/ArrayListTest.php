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
     * @expectedSuccess
     */
    public function testAddElementInFinalListWithPosition()
    {
        $list = new ArrayList();

        $this->assertTrue($list->add('wegerg'));
        $this->assertTrue($list->add(434365));
        $this->assertTrue($list->add('egw4363fger'));

        $this->assertTrue($list->addIn(2, 'hellooo'));

        $this->assertArrayHasKey(0, $list->getAll());
        $this->assertArrayHasKey(1, $list->getAll());
        $this->assertArrayHasKey(2, $list->getAll());
        $this->assertArrayHasKey(3, $list->getAll());

        $this->assertContains('wegerg', $list->getAll());
        $this->assertContains(434365, $list->getAll());
        $this->assertContains('egw4363fger', $list->getAll());
        $this->assertContains('hellooo', $list->getAll());

        $this->assertEquals('wegerg', $list->get(0));
        $this->assertEquals(434365, $list->get(1));
        $this->assertEquals('hellooo', $list->get(2));
        $this->assertEquals('egw4363fger', $list->get(3));
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testSetElementsInList(ArrayList $list)
    {
        $this->assertTrue($list->set(3, 155));
        $this->assertTrue($list->set(5, 'dsfsgh'));
        $this->assertTrue($list->set(0, new \stdClass()));

        $this->assertEquals(155, $list->get(3));
        $this->assertEquals('dsfsgh', $list->get(5));
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedException \RuntimeException
     */
    public function testExceptionBySetElementsInListWithNegativeIndex(ArrayList $list)
    {
        $list->set(-1, 155);
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testMergeAnotherCollectionListInCurrentList(ArrayList $list)
    {
        $list2 = new ArrayList();
        $list2->add('blue');
        $list2->add(235354);

        $this->assertTrue($list->merge($list2));

        $this->assertCount(8, $list->getAll());

        $this->assertArrayHasKey(0, $list->getAll());
        $this->assertArrayHasKey(1, $list->getAll());
        $this->assertArrayHasKey(2, $list->getAll());
        $this->assertArrayHasKey(3, $list->getAll());
        $this->assertArrayHasKey(4, $list->getAll());
        $this->assertArrayHasKey(5, $list->getAll());
        $this->assertArrayHasKey(6, $list->getAll());

        $this->assertEquals('world', $list->get(1));
        $this->assertEquals('helloooo', $list->get(2));
        $this->assertEquals(155, $list->get(3));
        $this->assertEquals('dsfsgh', $list->get(5));
        $this->assertEquals('blue', $list->get(6));
        $this->assertEquals(235354, $list->get(7));

        return $list;
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedException \RuntimeException
     */
    public function testExceptionByMergeAnotherCollectionListEmpty(ArrayList $list)
    {
        $list->merge(new ArrayList());
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testIfListContainsDeterminedElement(ArrayList $list)
    {
        $this->assertTrue($list->contains('blue'));
        $this->assertTrue($list->contains('helloooo'));
        $this->assertTrue($list->contains(235354));

        // Failure
        $this->assertFalse($list->contains(986));
    }

    /**
     * @test
     * @depends testAddElementsInList
     * @expectedSuccess
     */
    public function testGetFirstOccurrenceOfElement(ArrayList $list)
    {
        $this->assertEquals(6,$list->indexOf('blue'));
        $this->assertEquals(2,$list->indexOf('helloooo'));
        $this->assertEquals(5,$list->indexOf('dsfsgh'));
        $this->assertEquals(7,$list->indexOf(235354));

        // Failure
        $this->assertEquals(-1,$list->indexOf('sdkvsoijo'));
    }

    /**
     * @test
     * @depends testMergeAnotherCollectionListInCurrentList
     * @expectedSuccess
    */
    public function testGetLastOccurrenceOfElement(ArrayList $list)
    {
        $list->addIn(3, 'helloooo', true);

        $this->assertEquals(7, $list->lastIndexOf('blue'));
        $this->assertEquals(3, $list->lastIndexOf('helloooo'));
        $this->assertEquals(8, $list->lastIndexOf(235354));

        // Failure
        $this->assertEquals(-1, $list->lastIndexOf(1233));

        return $list;
    }

    /**
     * @test
     * @depends testGetLastOccurrenceOfElement
     * @expectedSuccess
     */
    public function testRemoveElementByIndex(ArrayList $list)
    {
        $this->assertTrue($list->remove(7));
        $this->assertTrue($list->remove(3));

        $this->assertCount(7, $list->getAll());

        $this->assertEquals(235354, $list->get(6));
        $this->assertEquals('helloooo', $list->get(2));

        $this->assertArrayHasKey(0, $list->getAll());
        $this->assertArrayHasKey(1, $list->getAll());
        $this->assertArrayHasKey(2, $list->getAll());
        $this->assertArrayHasKey(3, $list->getAll());
        $this->assertArrayHasKey(4, $list->getAll());
        $this->assertArrayHasKey(5, $list->getAll());
        $this->assertArrayHasKey(6, $list->getAll());

        return $list;
    }

    /**
     * @test
     * @depends testRemoveElementByIndex
     * @expectedException \RuntimeException
     */
    public function testExceptionByRemoveElementNotExisting(ArrayList $list)
    {
        $list->remove(9);
    }

    /**
     * @test
     * @depends testRemoveElementByIndex
     * @expectedSuccess
     */
    public function testRemoveFirstOccurrenceByElement(ArrayList $list)
    {
        $this->assertTrue($list->removeByElement(235354));
        $this->assertFalse($list->contains(235354));
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testRemoveLastOccurrenceByElement()
    {
        $list = new ArrayList();
        $list->add(12);
        $list->add(12, true);

        $this->assertCount(2, $list->getAll());

        $this->assertTrue($list->removeByElement(12, false, true));
        $this->assertEquals(12, $list->get(0));
        $this->assertTrue($list->contains(12));

        $this->assertCount(1, $list->getAll());

        // Failure
        $this->assertFalse($list->removeByElement(12433));

    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testRemoveFirstAndLastOccurrenceByElement()
    {
        $list = new ArrayList();
        $list->add(12);
        $list->add(12, true);
        $list->add('www');

        $this->assertCount(3, $list->getAll());

        $this->assertTrue($list->removeByElement(12, true, true));
        $this->assertEquals('www', $list->get(0));

        $this->assertCount(1, $list->getAll());

        // Failure
        $this->assertFalse($list->removeByElement(12));
        $this->assertFalse($list->contains(12));

    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testRemoveRangeElement()
    {
        $list = new ArrayList();
        $list->add(12);
        $list->add(12, true);
        $list->add('www');
        $list->add('2453466356');
        $list->add(346575);
        $list->add('dd');

        $this->assertTrue($list->removeRange(1, 4));
        $this->assertCount(2, $list->getAll());
        $this->assertEquals('12', $list->get(0));
        $this->assertEquals('dd', $list->get(1));

    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionByRemoveRangeEqualsIndex()
    {
        $list = new ArrayList();
        $list->add(12);
        $list->add(12, true);
        $list->add('www');
        $list->add('2453466356');
        $list->add(346575);
        $list->add('dd');

        $list->removeRange(1, 1);
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function testGetSubListOfCollectionList()
    {
        $list = new ArrayList();
        $list->add(12);
        $list->add(12, true);
        $list->add('www');
        $list->add('2453466356');
        $list->add(346575);
        $list->add('dd');
        $list->add(12);
        $list->add('helloooo');
        $list->add('15');
        $list->add(11.23);

        $subList = $list->subList(1, 6);

        $this->assertCount(6, $subList);

        $this->assertContains(12, $subList);
        $this->assertContains('www', $subList);
        $this->assertContains('2453466356', $subList);
        $this->assertContains(346575, $subList);
        $this->assertContains('dd', $subList);
        $this->assertContains(12, $subList);
        $this->assertContains('helloooo', $subList);

        $this->assertNotContains('15', $subList);
        $this->assertNotContains(11.23, $subList);
    }

}
