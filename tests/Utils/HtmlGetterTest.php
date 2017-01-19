<?php
namespace Tests\Utils;

use \PHPUnit_Framework_TestCase as TestCase;
use \Cosmos\Utils\HtmlGetter;

class HtmlGetterTest extends TestCase
{
    /**
     * @var HtmlGetter
    */
    protected $html = '';

    /**
     *
     */
    public function setUp()
    {
        $html = '<html><head><title>Testing..</title></head><body><h1>Hello!</h1></body></html>>';
        $this->html = new HtmlGetter($html);
    }

    /**
     * @test
     * @expectedSuccess
     */
    public function TestGetHtml()
    {
        $html = '<html><head><title>Testing..</title></head><body><h1>Hello!</h1></body></html>>';
        $this->assertEquals($html, $this->html);
    }

}
