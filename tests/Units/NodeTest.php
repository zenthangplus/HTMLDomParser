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
     * Test get child
     *
     * @covers \HTMLDomParser\Node::getChild
     */
    public function testGetChild()
    {
        $node = new Node('<div><a href="#">Test</a></div>');
        $child = $node->getChild(0);
        $this->assertInstanceOf(Node::class, $child);
        $this->assertEquals('div', $child->getName());
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
     * Test get children
     *
     * @covers \HTMLDomParser\Node::getChildren
     */
    public function testGetChildren()
    {
        $node = new Node('<div><a href="#">Test 1</a></div><div></div>');
        $children = $node->getChildren();
        $this->assertEquals(2, count($children));
        $this->assertContainsOnlyInstancesOf(Node::class, $children);
    }

    /**
     * Test get first child
     *
     * @covers \HTMLDomParser\Node::getFirstChild
     * @depends testGetNodeName
     */
    public function testGetFirstChild()
    {
        $node = new Node('<b>Test 1</b><strong>Test 2</strong>');
        $child = $node->getFirstChild();
        $this->assertInstanceOf(Node::class, $child);
        $this->assertEquals('b', $child->getName());
    }

    /**
     * Test get first child that return null
     *
     * @covers \HTMLDomParser\Node::getFirstChild
     */
    public function testGetFirstChildNull()
    {
        $node = new Node('<span></span>');
        $spanTag = $node->getChild(0);
        $this->assertNull($spanTag->getFirstChild());
    }

    /**
     * Test get last child
     *
     * @covers \HTMLDomParser\Node::getLastChild
     * @depends testGetNodeName
     */
    public function testGetLastChild()
    {
        $node = new Node('<b>Test 1</b><strong>Test 2</strong>');
        $child = $node->getLastChild();
        $this->assertInstanceOf(Node::class, $child);
        $this->assertEquals('strong', $child->getName());
    }

    /**
     * Test get last child that return null
     *
     * @covers \HTMLDomParser\Node::getLastChild
     */
    public function testGetLastChildNull()
    {
        $node = new Node('<span></span>');
        $spanTag = $node->getChild(0);
        $this->assertNull($spanTag->getLastChild());
    }

    /**
     * Test get parent
     *
     * @covers \HTMLDomParser\Node::getParent
     * @depends testGetFirstChild
     * @depends testGetNodeName
     */
    public function testGetParent()
    {
        $node = new Node('<ul><li>Test 1</li><li>Test2</li></ul>');
        $li = $node->getFirstChild()->getFirstChild();
        $parent = $li->getParent();
        $this->assertInstanceOf(Node::class, $parent);
        $this->assertEquals('ul', $parent->getName());
    }

    /**
     * Test set parent
     *
     * @covers \HTMLDomParser\Node::setParent
     * @depends testGetParent
     * @depends testGetNodeName
     */
    public function testSetParent()
    {
        $root1 = new Node('<b>Test</b>');
        $root2 = new Node('<span></span>');
        $bTag = $root1->getFirstChild();
        $spanTag = $root2->getFirstChild();
        $bTag->setParent($spanTag);
        $parent = $bTag->getParent();
        $this->assertInstanceOf(Node::class, $parent);
        $this->assertEquals('span', $parent->getName());

    }

    /**
     * Test get next sibling element
     *
     * @covers \HTMLDomParser\Node::getNextSibling
     * @depends testGetFirstChild
     * @depends testGetNodeName
     */
    public function testGetNextSibling()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $pTag = $root->getFirstChild();
        $nexSibling = $pTag->getNextSibling();
        $this->assertInstanceOf(Node::class, $nexSibling);
        $this->assertEquals('div', $nexSibling->getName());
    }

    /**
     * Test get next sibling element that return null
     *
     * @covers \HTMLDomParser\Node::getNextSibling
     * @depends testGetLastChild
     */
    public function testGetNextSiblingNull()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $divTag = $root->getLastChild();
        $this->assertNull($divTag->getNextSibling());
    }

    /**
     * Test get previous sibling element
     *
     * @covers \HTMLDomParser\Node::getPrevSibling
     * @depends testGetLastChild
     * @depends testGetNodeName
     */
    public function testGetPrevSibling()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $divTag = $root->getLastChild();
        $prevSibling = $divTag->getPrevSibling();
        $this->assertInstanceOf(Node::class, $prevSibling);
        $this->assertEquals('p', $prevSibling->getName());
    }

    /**
     * Test get previous sibling element that return null
     *
     * @covers \HTMLDomParser\Node::getPrevSibling
     * @depends testGetFirstChild
     */
    public function testGetPrevSiblingNull()
    {
        $root = new Node('<p><b>Test</b></p><div>Test</div>');
        $pTag = $root->getFirstChild();
        $this->assertNull($pTag->getPrevSibling());
    }

    /**
     * Test find ancestor tag
     *
     * @covers \HTMLDomParser\Node::findAncestorTag
     * @depends testGetFirstChild
     * @depends testGetNodeName
     */
    public function testFindAncestorTag()
    {
        $root = new Node('<div><p><b>Test</b></p></div>');
        $bTag = $root->getFirstChild()->getFirstChild()->getFirstChild();
        $element = $bTag->findAncestorTag('div');
        $this->assertInstanceOf(Node::class, $element);
        $this->assertEquals('div', $element->getName());

    }

    /**
     * Test find ancestor tag that return null
     *
     * @covers \HTMLDomParser\Node::findAncestorTag
     * @depends testFindAncestorTag
     */
    public function testFindAncestorTagNull()
    {
        $root = new Node('<div><p><b>Test</b></p></div>');
        $bTag = $root->getFirstChild()->getFirstChild()->getFirstChild();
        $this->assertNull($bTag->findAncestorTag('span'));
    }
}
