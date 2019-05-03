<?php

namespace HTMLDomParserTests\Units;

use HTMLDomParser\Contracts\NodeContract;
use HTMLDomParser\NodeFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class NodeFactoryTest
 * @package HTMLDomParserTests\Units
 */
class NodeFactoryTest extends TestCase
{
    /**
     * Test load NODE from html string
     *
     * @covers \HTMLDomParser\NodeFactory::load
     */
    public function testLoad()
    {
        $dom = NodeFactory::load('<b>Test</b>');
        $this->assertInstanceOf(NodeContract::class, $dom);
    }

    /**
     * Test load NODE from html file
     *
     * @covers \HTMLDomParser\NodeFactory::loadFile
     */
    public function testLoadFile()
    {
        $filepath = dirname(__FILE__) . '/fixtures/document.html';
        $dom = NodeFactory::loadFile($filepath);
        $this->assertInstanceOf(NodeContract::class, $dom);
    }
}
