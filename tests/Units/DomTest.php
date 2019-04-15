<?php

namespace HTMLDomParserTests\Units;

use PHPUnit\Framework\TestCase;
use HTMLDomParser\Dom;
use HTMLDomParser\Node;
use HTMLDomParser\Sources\simple_html_dom;
use HTMLDomParser\Sources\simple_html_dom_node;
use HTMLDomParserTests\Helpers\ReflectionHelper;

/**
 * Class DomTest
 * @package HTMLDomParserTests
 * @covers \HTMLDomParser\Dom
 */
class DomTest extends TestCase
{
    use ReflectionHelper;

    public $filepath = 'fixtures/document.html';

    public $html = '<div id="test"><a href="#">Test link</a></div>';

    /**
     * @var Dom
     */
    public $dom;

    /**
     * Init resources for this tests
     */
    public function setUp()
    {
        $this->dom = new Dom();
        $this->dom->loadFile(dirname(__FILE__) . '/' . $this->filepath);
    }

    /**
     * Destroy resources after test finished
     */
    public function tearDown()
    {
        unset($this->dom);
    }

    /**
     * Test load DOM form file
     *
     * @covers \HTMLDomParser\Dom::__construct
     * @covers \HTMLDomParser\Dom::loadFile
     */
    public function testLoadDomFromFile()
    {
        $this->assertInstanceOf(simple_html_dom_node::class, $this->dom->getSimpleNode());
    }

    /**
     * Test load DOM by html string
     *
     * @covers \HTMLDomParser\Dom::__construct
     * @covers \HTMLDomParser\Dom::load
     */
    public function testLoadDomByString()
    {
        $dom = new Dom($this->html);
        $this->assertInstanceOf(simple_html_dom_node::class, $dom->getSimpleNode());
    }

    /**
     * Test load DOM from simple_html_dom object
     *
     * @covers \HTMLDomParser\Dom::__construct
     * @covers \HTMLDomParser\Dom::loadObject
     */
    public function testLoadDomFromObject()
    {
        $object = new simple_html_dom($this->html);
        $dom = new Dom($object);
        $this->assertInstanceOf(simple_html_dom_node::class, $dom->getSimpleNode());
    }

    /**
     * Test set callback function
     *
     * @covers \HTMLDomParser\Dom::setCallback
     * @throws \ReflectionException
     */
    public function testSetCallback()
    {
        $this->dom->setCallback(function ($node) {
        });
        $simpleDom = $this->getInvisibleProperty($this->dom, "dom");
        $callback = $this->getInvisibleProperty($simpleDom, "callback");
        $this->assertInstanceOf(\Closure::class, $callback);
    }

    /**
     * Test remove callback
     *
     * @depends testSetCallback
     * @covers  \HTMLDomParser\Dom::removeCallback
     * @throws \ReflectionException
     */
    public function testRemoveCallback()
    {
        $this->dom->setCallback(function ($node) {
        });
        $this->dom->removeCallback();
        $simpleDom = $this->getInvisibleProperty($this->dom, "dom");
        $callback = $this->getInvisibleProperty($simpleDom, "callback");
        $this->assertNull($callback);
    }

    /**
     * Test dom's callback called with correct argument
     *
     * @depends testSetCallback
     * @covers \HTMLDomParser\Dom::setCallback
     */
    public function testCallbackCalledWithCorrectArgument()
    {
        $nodeCalled = null;
        $dom = new Dom('<strong>test</strong>');
        $dom->setCallback(function ($node) use (&$nodeCalled) {
            $nodeCalled = $node;
        });
        $_ = (string)$dom;
        $this->assertInstanceOf(Node::class, $nodeCalled);
    }
}
