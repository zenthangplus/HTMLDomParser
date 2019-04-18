<?php

namespace HTMLDomParserTests\Units;

use HTMLDomParser\Contracts\NodeContract;
use HTMLDomParser\Node;
use HTMLDomParser\Sources\simple_html_dom;
use HTMLDomParser\Sources\simple_html_dom_node;
use PHPUnit\Framework\TestCase;

/**
 * Class NodeTest
 * @package HTMLDomParserTests\Units
 */
class NodeTest extends TestCase
{
    public $filepath = 'fixtures/document.html';

    public $html = '<div id="test"><a href="#">Test link</a></div>';

    /**
     * @var NodeContract
     */
    public $node;

    /**
     * Init resources for this tests
     */
    public function setUp()
    {
        $this->node = new Node();
        $this->node->loadFile(dirname(__FILE__) . '/' . $this->filepath);
    }

    /**
     * Destroy resources after test finished
     */
    public function tearDown()
    {
        unset($this->node);
    }

    /**
     * Test load Node from file
     *
     * @covers \HTMLDomParser\Node::__construct
     * @covers \HTMLDomParser\Node::loadFile
     */
    public function testLoadNodeFromFile()
    {
        $this->assertInstanceOf(simple_html_dom_node::class, $this->node->getSimpleNode());
    }

    /**
     * Test load Node from html string
     *
     * @covers \HTMLDomParser\Node::__construct
     * @covers \HTMLDomParser\Node::load
     */
    public function testLoadNodeFromString()
    {
        $node = new Node();
        $node->load($this->html);
        $this->assertInstanceOf(simple_html_dom_node::class, $node->getSimpleNode());
    }

    /**
     * Test load Node from simple_html_dom_node object
     *
     * @covers \HTMLDomParser\Node::__construct
     * @covers \HTMLDomParser\Node::loadObject
     */
    public function testLoadNodeFromObject()
    {
        $object = new simple_html_dom($this->html);
        $node = new Node($object->root);
        $this->assertInstanceOf(simple_html_dom_node::class, $node->getSimpleNode());
    }

    /**
     * Test get Node name
     *
     * @covers \HTMLDomParser\Node::getName
     */
    public function testGetNodeName()
    {
        $node = new Node('Test');
        $this->assertEquals('root', $node->getName());
    }

    /**
     * Test node has child
     *
     * @covers \HTMLDomParser\Node::hasChild
     */
    public function testHasChild()
    {
        $node = new Node('<div><a href="#">Test</a></div>');
        $this->assertTrue($node->hasChild());
    }

    /**
     * Test get child
     *
     * @covers \HTMLDomParser\Node::getChild
     */
    public function testGetChild()
    {
        $node = new Node('<div><a href="#">Test</a></div>');
        $this->assertInstanceOf(Node::class, $node->getChild(0));
    }

    /**
     * Test get child with invalid index
     *
     * @covers \HTMLDomParser\Node::getChild
     */
    public function testGetChildWithInvalidIndex()
    {
        $node = new Node('<div><a href="#">Test</a></div>');
        $this->assertNull($node->getChild(-1));
    }

    /**
     * Test get children
     *
     * @covers \HTMLDomParser\Node::getChildren
     */
    public function testGetChildren()
    {
        $node = new Node('<div><a href="#">Test 1</a></div><div></div>');
        $this->assertEquals(2, count($node->getChildren()));
    }

    /**
     * Test get children with correct data type
     *
     * @covers \HTMLDomParser\Node::getChildren
     */
    public function testGetChildrenWithCorrectType()
    {
        $node = new Node('<div><a href="#">Test 1</a></div><div></div>');
        $this->assertContainsOnlyInstancesOf(Node::class, $node->getChildren());
    }

    /**
     * Test get first child with correct data type
     *
     * @covers \HTMLDomParser\Node::getFirstChild
     */
    public function testGetFirstChildWithCorrectType()
    {
        $node = new Node('<b>Test 1</b><strong>Test 2</strong>');
        $this->assertInstanceOf(Node::class, $node->getFirstChild());
    }

    /**
     * Test get first child with correct tag name
     *
     * @covers \HTMLDomParser\Node::getFirstChild
     * @depends testGetNodeName
     * @depends testGetFirstChildWithCorrectType
     */
    public function testGetFirstChildWithCorrectTag()
    {
        $node = new Node('<b>Test 1</b><strong>Test 2</strong>');
        $this->assertEquals('b', $node->getFirstChild()->getName());
    }

    /**
     * Test get last child with correct data type
     *
     * @covers \HTMLDomParser\Node::getLastChild
     */
    public function testGetLastChildWithCorrectType()
    {
        $node = new Node('<b>Test 1</b><strong>Test 2</strong>');
        $this->assertInstanceOf(Node::class, $node->getLastChild());
    }

    /**
     * Test get last child with correct tag name
     *
     * @covers \HTMLDomParser\Node::getLastChild
     * @depends testGetNodeName
     * @depends testGetLastChildWithCorrectType
     */
    public function testGetLastChildWithCorrectTag()
    {
        $node = new Node('<b>Test 1</b><strong>Test 2</strong>');
        $this->assertEquals('strong', $node->getLastChild()->getName());
    }
}
