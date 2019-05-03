<?php

namespace HTMLDomParserTests\Units;

use HTMLDomParser\Contracts\DomContract;
use HTMLDomParser\DomFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class DomFactoryTest
 * @package HTMLDomParserTests\Units
 */
class DomFactoryTest extends TestCase
{
    /**
     * Test load DOM from html string
     *
     * @covers \HTMLDomParser\DomFactory::load
     */
    public function testLoad()
    {
        $dom = DomFactory::load('<b>Test</b>');
        $this->assertInstanceOf(DomContract::class, $dom);
    }

    /**
     * Test load DOM from html file
     *
     * @covers \HTMLDomParser\DomFactory::loadFile
     */
    public function testLoadFile()
    {
        $filepath = dirname(__FILE__) . '/fixtures/document.html';
        $dom = DomFactory::loadFile($filepath);
        $this->assertInstanceOf(DomContract::class, $dom);
    }
}
