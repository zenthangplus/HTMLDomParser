<?php

namespace HTMLDomParserTests\Units\Traits;

use HTMLDomParser\Contracts\NodeContract;
use HTMLDomParser\Traits\NodeCreators;
use PHPUnit\Framework\TestCase;

/**
 * Class NodeCreatorsTest
 * @package HTMLDomParserTests\Units\Traits
 */
class NodeCreatorsTest extends TestCase
{
    /**
     * Mock for NodeCreators
     *
     * @var \PHPUnit_Framework_MockObject_MockObject|NodeCreators
     */
    public $mock;

    /**
     * Setup tests
     */
    public function setUp()
    {
        $this->mock = $this->getMockForTrait(NodeCreators::class);
    }

    /**
     * Test create Node with a html string
     *
     * @covers \HTMLDomParser\Traits\NodeCreators::create
     */
    public function testCreate()
    {
        $this->assertInstanceOf(NodeContract::class, $this->mock->create('<b>Test</b>'));
    }

    /**
     * Test create Node with a file
     *
     * @covers \HTMLDomParser\Traits\NodeCreators::createFromFile
     */
    public function testCreateFromFile()
    {
        $filepath = dirname(__FILE__) . '/../fixtures/document.html';
        $this->assertInstanceOf(NodeContract::class, $this->mock->createFromFile($filepath));
    }
}
