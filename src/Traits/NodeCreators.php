<?php

namespace SimpleHtmlDom\Traits;

use SimpleHtmlDom\Contracts\NodeContract;
use SimpleHtmlDom\Node;

/**
 * Trait NodeCreators
 * @package SimpleHtmlDom\Traits
 */
trait NodeCreators
{
    /**
     * Create new node from html string
     *
     * @see Node::loadString()
     * @param string $html
     * @return NodeContract
     */
    public static function create($html)
    {
        $node = new Node;
        $node->load($html);
        return $node;
    }

    /**
     * Create new node from html file
     *
     * @param string $htmlFile
     * @return NodeContract
     */
    public static function createFromFile($htmlFile)
    {
        $node = new Node;
        $node->loadFile($htmlFile);
        return $node;
    }
}
