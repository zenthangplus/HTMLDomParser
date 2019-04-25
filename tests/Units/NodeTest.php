<?php

namespace HTMLDomParserTests\Units;

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
    /**
     * Test load Node from file
     *
     * @covers \HTMLDomParser\Node::__construct
     * @covers \HTMLDomParser\Node::loadFile
     */
    public function testLoadNodeFromFile()
    {
        $node = new Node();
        $node->loadFile($this->getFixturesPath('document.html'));
        $this->assertInstanceOf(simple_html_dom_node::class, $node->getSimpleNode());
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
        $node->load('<a href="#">Test</a>');
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
        $object = new simple_html_dom('<a href="#">Test</a>');
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
        $this->assertCount(2, $children);
        $this->assertContainsOnlyInstancesOf(Node::class, $children);
    }

    /**
     * Test get first child
     *
     * @covers  \HTMLDomParser\Node::getFirstChild
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
     * @covers  \HTMLDomParser\Node::getLastChild
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
     * @covers  \HTMLDomParser\Node::getParent
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
     * @covers  \HTMLDomParser\Node::setParent
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
     * @covers  \HTMLDomParser\Node::getNextSibling
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
     * @covers  \HTMLDomParser\Node::getNextSibling
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
     * @covers  \HTMLDomParser\Node::getPrevSibling
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
     * @covers  \HTMLDomParser\Node::getPrevSibling
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
     * @covers  \HTMLDomParser\Node::findAncestorTag
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
     * @covers  \HTMLDomParser\Node::findAncestorTag
     * @depends testFindAncestorTag
     */
    public function testFindAncestorTagNull()
    {
        $root = new Node('<div><p><b>Test</b></p></div>');
        $bTag = $root->getFirstChild()->getFirstChild()->getFirstChild();
        $this->assertNull($bTag->findAncestorTag('span'));
    }

    /**
     * Test find elements by ID
     *
     * @covers \HTMLDomParser\Node::find
     */
    public function testFindById()
    {
        $root = new Node('<div id="wrapper"><b>Test</b></div>');
        $elements = $root->find('#wrapper');
        $this->assertCount(1, $elements);
        $this->assertContainsOnlyInstancesOf(Node::class, $elements);
    }

    /**
     * Test find elements by class name
     *
     * @covers \HTMLDomParser\Node::find
     */
    public function testFindByClass()
    {
        $root = new Node('<div class="test"><div class="test">Test<span class="test">Test 1</span></div></div>');
        $elements = $root->find('.test');
        $this->assertCount(3, $elements);
        $this->assertContainsOnlyInstancesOf(Node::class, $elements);
    }

    /**
     * Test find elements by tag name
     *
     * @covers \HTMLDomParser\Node::find
     */
    public function testFindByTagName()
    {
        $root = new Node('<div id="wrapper"><b>Test 1</b><b>Test 2</b><b>Test 3</b></div>');
        $elements = $root->find('b');
        $this->assertCount(3, $elements);
        $this->assertContainsOnlyInstancesOf(Node::class, $elements);
    }

    /**
     * Test find elements by css selector
     *
     * @covers \HTMLDomParser\Node::find
     */
    public function testFindComplex()
    {
        $root = new Node('<div id="wrapper"><ul class="list"><li>Item 1</li><li>Item 2</li></ul></div>');
        $elements = $root->find('#wrapper ul.list>li');
        $this->assertCount(2, $elements);
        $this->assertContainsOnlyInstancesOf(Node::class, $elements);
    }

    /**
     * Test find elements that doesn't exists
     *
     * @covers \HTMLDomParser\Node::find
     */
    public function testFindNotExists()
    {
        $root = new Node('<div id="wrapper"><b>Test</b></div>');
        $elements = $root->find('.container');
        $this->assertCount(0, $elements);
    }

    /**
     * Test find one element
     *
     * @covers \HTMLDomParser\Node::findOne
     */
    public function testFindOne()
    {
        $root = new Node('<div id="wrapper"><ul class="list"><li>Item 1</li><li>Item 2</li></ul></div>');
        $element = $root->findOne('#wrapper .list li');
        $this->assertInstanceOf(Node::class, $element);
        $this->assertEquals('Item 1', $element->text());
    }

    /**
     * Test find one element that doesn't exists
     *
     * @covers \HTMLDomParser\Node::findOne
     */
    public function testFindOneNotExists()
    {
        $root = new Node('<div id="wrapper"><ul class="list"><li>Item 1</li><li>Item 2</li></ul></div>');
        $element = $root->findOne('.container #wrapper');
        $this->assertNull($element);
    }

    /**
     * Test get element by ID
     *
     * @covers \HTMLDomParser\Node::getElementById
     */
    public function testGetElementById()
    {
        $root = new Node('<div class="container"><ul><li>Item 1</li><li id="item-2">Item 2</li></ul></div>');
        $element = $root->getElementById('item-2');
        $this->assertInstanceOf(Node::class, $element);
        $this->assertEquals('Item 2', $element->text());
    }

    /**
     * Test get element by ID that doesn't exists
     *
     * @covers \HTMLDomParser\Node::getElementById
     */
    public function testGetElementByIdNotExists()
    {
        $root = new Node('<div class="container"><ul><li>Item 1</li><li id="item-2">Item 2</li></ul></div>');
        $element = $root->getElementById('item-1');
        $this->assertNull($element);
    }

    /**
     * Test get a element by tag name
     *
     * @covers \HTMLDomParser\Node::getElementByTagName
     */
    public function testGetElementByTagName()
    {
        $root = new Node('<div class="container"><ul><li>Item 1</li><li id="item-2">Item 2</li></ul></div>');
        $element = $root->getElementByTagName('li');
        $this->assertInstanceOf(Node::class, $element);
        $this->assertEquals('Item 1', $element->text());
    }

    /**
     * Test get a element by tag name that doesn't exists
     *
     * @covers \HTMLDomParser\Node::getElementByTagName
     */
    public function testGetElementByTagNameNotExists()
    {
        $root = new Node('<div class="container"><ul><li>Item 1</li><li id="item-2">Item 2</li></ul></div>');
        $element = $root->getElementByTagName('a');
        $this->assertNull($element);
    }

    /**
     * Test get elements by tag name
     *
     * @covers \HTMLDomParser\Node::getElementsByTagName
     */
    public function testGetElementsByTagName()
    {
        $root = new Node('<div class="container"><ul><li>Item 1</li><li id="item-2">Item 2</li></ul></div>');
        $elements = $root->getElementsByTagName('li');
        $this->assertCount(2, $elements);
        $this->assertContainsOnlyInstancesOf(Node::class, $elements);
    }

    /**
     * Test get elements by tag name that doesn't exists
     *
     * @covers \HTMLDomParser\Node::getElementsByTagName
     */
    public function testGetElementsByTagNameNotExists()
    {
        $root = new Node('<div class="container"><ul><li>Item 1</li><li id="item-2">Item 2</li></ul></div>');
        $elements = $root->getElementsByTagName('a');
        $this->assertCount(0, $elements);
    }

    /**
     * Test get inner html
     *
     * @covers  \HTMLDomParser\Node::innerHtml
     * @depends testGetFirstChild
     */
    public function testGetInnerHtml()
    {
        $root = new Node('<div id="wrapper"><b>Test</b></div>');
        $wrapper = $root->getFirstChild();
        $this->assertEquals('<b>Test</b>', $wrapper->innerHtml());
    }

    /**
     * Test get inner xml
     *
     * @covers  \HTMLDomParser\Node::innerXml
     * @depends testGetFirstChild
     */
    public function testGetInnerXml()
    {
        $root = new Node('<div id="wrapper"><![CDATA[<b>Test</b>]]></div>');
        $wrapper = $root->getFirstChild();
        $this->assertEquals('<b>Test</b>', $wrapper->innerXml());
    }

    /**
     * Test get outer html
     *
     * @covers  \HTMLDomParser\Node::outerHtml
     * @depends testGetFirstChild
     */
    public function testGetOuterHtml()
    {
        $root = new Node('<div id="wrapper"><b>Test</b></div>');
        $bTag = $root->getFirstChild()->getFirstChild();
        $this->assertEquals('<b>Test</b>', $bTag->outerHtml());
    }

    /**
     * Test get inner text
     *
     * @covers  \HTMLDomParser\Node::text
     * @depends testGetFirstChild
     */
    public function testGetText()
    {
        $root = new Node('<div id="wrapper">This is <b>test</b> text</div>');
        $wrapper = $root->getFirstChild();
        $this->assertEquals('This is test text', $wrapper->text());
    }

    /**
     * Test get attribute by name
     *
     * @covers  \HTMLDomParser\Node::getAttribute
     * @depends testGetFirstChild
     */
    public function testGetAttribute()
    {
        $root = new Node('<a href="#" class="test">Test</a>');
        $anchor = $root->getFirstChild();
        $this->assertEquals('#', $anchor->getAttribute('href'));
    }

    /**
     * Test set attribute for a element
     *
     * @covers  \HTMLDomParser\Node::setAttribute
     * @depends testGetFirstChild
     * @depends testGetAttribute
     * @depends testGetOuterHtml
     */
    public function testSetAttribute()
    {
        $root = new Node('<a href="#">Test</a>');
        $anchor = $root->getFirstChild();
        $anchor->setAttribute('class', 'test');
        $this->assertEquals('test', $anchor->getAttribute('class'));
        $this->assertEquals('#', $anchor->getAttribute('href'));
        $this->assertEquals('<a href="#" class="test">Test</a>', $anchor->outerHtml());
    }

    /**
     * Test get all attribute of a element
     *
     * @covers  \HTMLDomParser\Node::getAttributes
     * @depends testGetFirstChild
     */
    public function testGetAttributes()
    {
        $root = new Node('<a href="#" class="test">Test</a>');
        $anchor = $root->getFirstChild();
        $this->assertEquals(['href' => '#', 'class' => 'test'], $anchor->getAttributes());
    }

    /**
     * Test check element has attribute
     *
     * @covers  \HTMLDomParser\Node::hasAttribute
     * @depends testGetFirstChild
     */
    public function testHasAttribute()
    {
        $root = new Node('<a href="#" class="test">Test</a>');
        $anchor = $root->getFirstChild();
        $this->assertTrue($anchor->hasAttribute('class'));
        $this->assertFalse($anchor->hasAttribute('title'));
    }

    /**
     * Test remove attribute of a element
     *
     * @covers  \HTMLDomParser\Node::removeAttribute
     * @depends testGetFirstChild
     * @depends testGetAttribute
     * @depends testGetOuterHtml
     */
    public function testRemoveAttribute()
    {
        $root = new Node('<a href="#" class="test">Test</a>');
        $anchor = $root->getFirstChild();
        $anchor->removeAttribute('class');
        $this->assertEmpty($anchor->getAttribute('class'));
        $this->assertEquals('<a href="#">Test</a>', $anchor->outerHtml());
    }

    /**
     * Test append a element to other element
     *
     * @covers  \HTMLDomParser\Node::appendChild
     * @depends testGetOuterHtml
     */
    public function testAppendChild()
    {
        $root = new Node('<b>Test 1</b>');
        $element = new Node('<b>Test 2</b>');
        $root->appendChild($element);
        $this->assertEquals('<b>Test 1</b><b>Test 2</b>', $root->outerHtml());
    }

    /**
     * Test cast node to string
     *
     * @covers \HTMLDomParser\Node::__toString
     */
    public function testToString()
    {
        $root = new Node('<b>Test 1</b>');
        $this->assertEquals('<b>Test 1</b>', (string)$root);
    }

    /**
     * Test save node to a html file
     *
     * @covers \HTMLDomParser\Node::save
     */
    public function testSave()
    {
        $html = '<div class="container"><b>Test 1</b></div>';
        $filepath = $this->getFixturesPath('tmp/tmp.html');
        $root = new Node($html);
        $root->save($filepath);
        $this->assertEquals($html, file_get_contents($filepath));
    }

    /**
     * Test get simple node
     *
     * @covers \HTMLDomParser\Node::getSimpleNode
     */
    public function testGetSimpleNode()
    {
        $root = new Node('<b>Test</b>');
        $this->assertInstanceOf(simple_html_dom_node::class, $root->getSimpleNode());
    }

    /**
     * Get fixtures path for these tests
     *
     * @param string $file
     * @return string
     */
    protected function getFixturesPath($file)
    {
        return dirname(__FILE__) . '/fixtures/' . $file;
    }

    /**
     * Destroy resources after test finished
     */
    public function tearDown()
    {
        // Remove all tmp files
        $files = glob($this->getFixturesPath('tmp') . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                @unlink($file);
            }
        }
    }
}
