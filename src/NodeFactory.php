<?php

namespace HTMLDomParser;

use HTMLDomParser\Contracts\NodeContract;

/**
 * Class NodeFactory
 * @package HTMLDomParser
 */
class NodeFactory
{
    /**
     * Load node from html string
     *
     * @see Node::load()
     * @param string $html
     * @return NodeContract
     */
    public static function load($html)
    {
        $node = new Node;
        $node->load($html);
        return $node;
    }

    /**
     * Load node from html file
     *
     * @see Node::loadFile()
     * @param string $htmlFile
     * @return NodeContract
     */
    public static function loadFile($htmlFile)
    {
        $node = new Node;
        $node->loadFile($htmlFile);
        return $node;
    }
}
