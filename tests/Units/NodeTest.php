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
     * Test node hasn't child
     *
     * @covers \HTMLDomParser\Node::hasChild
     */
    public function testNotHasChild()
    {
        $root = new Node('<span></span>');
        $spanTag = $root->getFirstChild();
        $this->assertFalse($spanTag->hasChild());
    }

    /**
     * Test get child with correct data type
     *
     * @covers \HTMLDomParser\Node::getChild
     */
    public function testGetChildWithCorrectType()
    {
        $node = new Node('<div><a href="#">Test</a></div>');
        $this->assertInstanceOf(Node::class, $node->getChild(0));
    }

    /**
     * Test get child with correct tag
     *
     * @covers \HTMLDomParser\Node::getChild
     * @depends testGetChildWithCorrectType
     */
    public function testGetChildWithCorrectTag()
    {
        $node = new Node('<div><a href="#">Test</a></div>');
        $this->assertEquals('div', $node->getChild(0)->getName());
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
     * Test get child by an index which doesn't exists
     *
     * @covers \HTMLDomParser\Node::getChild
     */
    public function testGetChildWithIndexNotExists()
    {
        $node = new Node('<div><a href="#">Test</a></div>');
        $this->assertNull($node->getChild(1));
    }

    /**
     * Test get children with correct number of children
     *
     * @covers \HTMLDomParser\Node::getChildren
     */
    public function testGetChildrenWithCorrectNumber()
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
     * Test get first child that return null
     *
     * @covers \HTMLDomParser\Node::getFirstChild
     * @depends testGetChildWithCorrectTag
     */
    public function testGetFirstChildNull()
    {
        $node = new Node('<span></span>');
        $spanTag = $node->getChild(0);
        $this->assertNull($spanTag->getFirstChild());
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

    /**
     * Test get last child that return null
     *
     * @covers \HTMLDomParser\Node::getLastChild
     * @depends testGetChildWithCorrectTag
     */
    public function testGetLastChildNull()
    {
        $node = new Node('<span></span>');
        $spanTag = $node->getChild(0);
        $this->assertNull($spanTag->getLastChild());
    }

    /**
     * Test get parent with correct type
     *
     * @covers \HTMLDomParser\Node::getParent
     * @depends testGetFirstChildWithCorrectTag
     */
    public function testGetParentWithCorrectType()
    {
        $node = new Node('<ul><li>Test 1</li><li>Test2</li></ul>');
        $li = $node->getFirstChild()->getFirstChild();
        $this->assertInstanceOf(Node::class, $li->getParent());
    }

    /**
     * Test get parent with correct tag
     *
     * @covers \HTMLDomParser\Node::getParent
     * @depends testGetParentWithCorrectType
     */
    public function testGetParentWithCorrectTag()
    {
        $node = new Node('<ul><li>Test 1</li><li>Test2</li></ul>');
        $li = $node->getFirstChild()->getFirstChild();
        $this->assertEquals('ul', $li->getParent()->getName());
    }

    /**
     * Test set parent with correct type
     *
     * @covers \HTMLDomParser\Node::setParent
     * @depends testGetParentWithCorrectTag
     */
    public function testSetParentWithCorrectType()
    {
        $root1 = new Node('<b>Test</b>');
        $root2 = new Node('<span></span>');
        $bTag = $root1->getFirstChild();
        $spanTag = $root2->getFirstChild();
        $bTag->setParent($spanTag);
        $this->assertInstanceOf(Node::class, $bTag->getParent());
    }

    /**
     * Test set parent with correct tag
     *
     * @covers \HTMLDomParser\Node::setParent
     * @depends testGetParentWithCorrectType
     */
    public function testSetParentWithCorrectTag()
    {
        $root1 = new Node('<b>Test</b>');
        $root2 = new Node('<span></span>');
        $bTag = $root1->getFirstChild();
        $spanTag = $root2->getFirstChild();
        $bTag->setParent($spanTag);
        $this->assertEquals('span', $bTag->getParent()->getName());
    }

    /**
     * Test get next sibling element with correct type
     *
     * @covers \HTMLDomParser\Node::getNextSibling
     * @depends testGetFirstChildWithCorrectTag
     */
    public function testGetNextSiblingWithCorrectType()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $pTag = $root->getFirstChild();
        $this->assertInstanceOf(Node::class, $pTag->getNextSibling());
    }

    /**
     * Test get next sibling element with correct tag
     *
     * @covers \HTMLDomParser\Node::getNextSibling
     * @depends testGetNextSiblingWithCorrectType
     */
    public function testGetNextSiblingWithCorrectTag()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $pTag = $root->getFirstChild();
        $this->assertEquals('div', $pTag->getNextSibling()->getName());
    }

    /**
     * Test get next sibling element that return null
     *
     * @covers \HTMLDomParser\Node::getNextSibling
     * @depends testGetLastChildWithCorrectTag
     */
    public function testGetNextSiblingNull()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $divTag = $root->getLastChild();
        $this->assertNull($divTag->getNextSibling());
    }

    /**
     * Test get previous sibling element with correct type
     *
     * @covers \HTMLDomParser\Node::getPrevSibling
     * @depends testGetLastChildWithCorrectTag
     */
    public function testGetPrevSiblingWithCorrectType()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $divTag = $root->getLastChild();
        $this->assertInstanceOf(Node::class, $divTag->getPrevSibling());
    }

    /**
     * Test get previous sibling element with correct tag
     *
     * @covers \HTMLDomParser\Node::getPrevSibling
     * @depends testGetPrevSiblingWithCorrectType
     */
    public function testGetPrevSiblingWithCorrectTag()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $divTag = $root->getLastChild();
        $this->assertEquals('p', $divTag->getPrevSibling()->getName());
    }

    /**
     * Test get previous sibling element that return null
     *
     * @covers \HTMLDomParser\Node::getPrevSibling
     * @depends testGetFirstChildWithCorrectTag
     */
    public function testGetPrevSiblingNull()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $pTag = $root->getFirstChild();
        $this->assertNull($pTag->getPrevSibling());
    }
}
