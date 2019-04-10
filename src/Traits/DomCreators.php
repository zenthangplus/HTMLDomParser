<?php

namespace SimpleHtmlDom\Traits;

use SimpleHtmlDom\Contracts\DomContract;
use SimpleHtmlDom\Dom;
use SimpleHtmlDom\Node;

/**
 * Trait DomCreators
 * @package SimpleHtmlDom\Traits
 */
trait DomCreators
{
    /**
     * Create new DOM from html string
     *
     * @see Node::loadString()
     * @param string $html
     * @return DomContract
     */
    public static function create($html)
    {
        $node = new Dom;
        $node->load($html);
        return $node;
    }

    /**
     * Create new DOM from html file
     *
     * @param string $htmlFile
     * @return DomContract
     */
    public static function createFromFile($htmlFile)
    {
        $node = new Dom;
        $node->loadFile($htmlFile);
        return $node;
    }
}
