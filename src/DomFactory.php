<?php

namespace HTMLDomParser;

use HTMLDomParser\Contracts\DomContract;

/**
 * Class DomFactory
 * @package HTMLDomParser
 */
class DomFactory
{
    /**
     * Load DOM from html string
     *
     * @see Dom::load()
     * @param string $html
     * @return DomContract
     */
    public static function load($html)
    {
        $node = new Dom;
        $node->load($html);
        return $node;
    }

    /**
     * Load DOM from html file
     *
     * @see Dom::loadFile()
     * @param string $htmlFile
     * @return DomContract
     */
    public static function loadFile($htmlFile)
    {
        $node = new Dom;
        $node->loadFile($htmlFile);
        return $node;
    }
}
