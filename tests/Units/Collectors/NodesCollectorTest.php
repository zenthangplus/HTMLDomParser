<?php

namespace HTMLDomParserTests\Units\Collectors;

use HTMLDomParser\Collectors\NodesCollector;
use HTMLDomParser\Contracts\NodeContract;
use HTMLDomParser\Contracts\NodesCollectorContract;
use HTMLDomParser\Node;
use HTMLDomParser\Sources\simple_html_dom_node;
use HTMLDomParserTests\Helpers\ReflectionHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class NodesCollectorTest
 * @package HTMLDomParserTests\Units\Collectors
 */
class NodesCollectorTest extends TestCase
{
    use ReflectionHelper;

    /**
     * @var simple_html_dom_node[]
     */
    public $rawNodes;

    /**
     * Setup tests
     */
    public function setUp()
    {
        $root = Node::create('<ul><li>Test 1</li><li>Test 2</li></ul>');
        $ul = $root->getFirstChild();
        $this->rawNodes = [
            $ul->getChild(0)->getSimpleNode(),
            $ul->getChild(1)->getSimpleNode(),
        ];
    }

    /**
     * Remove all resources after finish tests
     */
    public function tearDown()
    {
        unset($this->rawNodes);
    }

    /**
     * Get NodesCollector object for test
     *
     * @return NodesCollectorContract
     */
    public function getNodesCollector()
    {
        return new NodesCollector($this->rawNodes);
    }

    /**
     * @throws \ReflectionException
     */
    public function testConstructor()
    {
        $collector = new NodesCollector($this->rawNodes);
        $rawNodes = $this->getInvisibleProperty($collector, 'rawNodes');
        $this->assertEquals($this->rawNodes, $rawNodes);
    }

    /**
     * Test count elements of collector
     *
     * @covers \HTMLDomParser\Collectors\NodesCollector::count
     */
    public function testCount()
    {
        $this->assertEquals(2, $this->getNodesCollector()->count());
    }

    /**
     * Test get current element
     *
     * @covers \HTMLDomParser\Collectors\NodesCollector::current
     */
    public function testCurrent()
    {
        $collector = $this->getNodesCollector();
        $this->assertInstanceOf(NodeContract::class, $collector->current());
        $this->assertEquals('Test 1', $collector->current()->text());
    }

    /**
     * Test move to next element
     *
     * @covers \HTMLDomParser\Collectors\NodesCollector::next
     * @depends testCurrent
     */
    public function testNext()
    {
        $collector = $this->getNodesCollector();
        $collector->next();
        $this->assertInstanceOf(NodeContract::class, $collector->current());
        $this->assertEquals('Test 2', $collector->current()->text());
    }

    /**
     * Test get current index of collector
     *
     * @covers \HTMLDomParser\Collectors\NodesCollector::key
     * @depends testNext
     */
    public function testGetKey()
    {
        $collector = $this->getNodesCollector();
        $collector->next();
        $this->assertEquals(1, $collector->key());
    }

    /**
     * Test valid key with a key already exists
     *
     * @covers \HTMLDomParser\Collectors\NodesCollector::valid
     * @depends testNext
     */
    public function testValidKeyWithValidKey()
    {
        $collector = $this->getNodesCollector();
        $collector->next();// Jump to element idx 1
        $this->assertTrue($collector->valid());
    }

    /**
     * Test valid key with a invalid key
     *
     * @covers \HTMLDomParser\Collectors\NodesCollector::valid
     * @depends testNext
     */
    public function testValidKeyWithInvalidKey()
    {
        $collector = $this->getNodesCollector();
        $collector->next();// Jump to element idx 1
        $collector->next();// Jump to element idx 2 (invalid idx)
        $this->assertFalse($collector->valid());
    }

    /**
     * Test rewind collector to the first element
     *
     * @covers \HTMLDomParser\Collectors\NodesCollector::rewind
     * @depends testNext
     * @depends testGetKey
     */
    public function testRewind()
    {
        $collector = $this->getNodesCollector();
        $collector->next();// Jump to element idx 1
        $collector->rewind();
        $this->assertEquals(0, $collector->key());
    }
}
