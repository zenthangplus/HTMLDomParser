<?php

namespace HTMLDomParserTests\Units\Traits;

use HTMLDomParser\Contracts\DomContract;
use HTMLDomParser\Traits\DomCreators;
use PHPUnit\Framework\TestCase;

/**
 * Class DomCreatorsTest
 * @package HTMLDomParserTests\Units\Traits
 */
class DomCreatorsTest extends TestCase
{
    /**
     * Mock for DomCreators
     *
     * @var \PHPUnit_Framework_MockObject_MockObject|DomCreators
     */
    public $mock;

    /**
     * Setup tests
     */
    public function setUp()
    {
        $this->mock = $this->getMockForTrait(DomCreators::class);
    }

    /**
     * Test create Dom with a html string
     *
     * @covers \HTMLDomParser\Traits\DomCreators::create
     */
    public function testCreate()
    {
        $this->assertInstanceOf(DomContract::class, ($this->mock)::create('<b>Test</b>'));
    }

    /**
     * Test create Dom with a file
     *
     * @covers \HTMLDomParser\Traits\DomCreators::createFromFile
     */
    public function testCreateFromFile()
    {
        $filepath = dirname(__FILE__) . '/../fixtures/document.html';
        $this->assertInstanceOf(DomContract::class, ($this->mock)::createFromFile($filepath));
    }
}
