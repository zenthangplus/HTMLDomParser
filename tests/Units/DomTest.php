<?php

namespace HTMLDomParserTests\Units;

use HTMLDomParser\Dom;
use HTMLDomParser\Sources\simple_html_dom;
use HTMLDomParser\Sources\simple_html_dom_node;
use HTMLDomParserTests\Helpers\ReflectionHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class DomTest
 * @package HTMLDomParserTests
 * @covers \HTMLDomParser\Dom
 */
class DomTest extends TestCase
{
    use ReflectionHelper;

    public $filepath = '/fixtures/document.html';

    public $html = '<div id="test"><a href="#">Test link</a></div>';

    /**
     * @var Dom
     */
    public $dom;

    public function setUp()
    {
        $this->dom = new Dom();
        $this->dom->loadFile(dirname(__FILE__) . $this->filepath);
    }

    public function tearDown()
    {
        unset($this->dom);
    }

    /**
     * Test load DOM form file
     */
    public function testLoadDomFromFile()
    {
        $this->assertInstanceOf(simple_html_dom_node::class, $this->dom->getSimpleNode());
    }

    /**
     * Test load DOM by html string
     */
    public function testLoadDomByString()
    {
        $dom = new Dom($this->html);
        $this->assertInstanceOf(simple_html_dom_node::class, $dom->getSimpleNode());
    }

    /**
     * Test load DOM from simple_html_dom object
     */
    public function testLoadDomFromObject()
    {
        $object = new simple_html_dom($this->html);
        $dom = new Dom($object);
        $this->assertInstanceOf(simple_html_dom_node::class, $dom->getSimpleNode());
    }
}
