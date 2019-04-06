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
        $node->loadString($html);
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

    /**
     * Create new DOM from simple_html_dom
     *
     * @see Node::loadSimpleDom()
     * @param \SimpleHtmlDom\Sources\simple_html_dom $simpleDom
     * @return DomContract
     */
    public static function createFromSimpleDom($simpleDom)
    {
        $node = new Dom;
        $node->loadSimpleDom($simpleDom);
        return $node;
    }
}
