<?php

namespace SimpleHtmlDom\Collectors;

use SimpleHtmlDom\Node;
use SimpleHtmlDom\Sources\simple_html_dom_node;
use SimpleHtmlDom\Contracts\NodesCollectorContract;

/**
 * Class NodesCollector
 * @package SimpleHtmlDom
 */
class NodesCollector implements NodesCollectorContract
{
    /**
     * Store list of simple_html_dom_node which want to iterate
     *
     * @var simple_html_dom_node[]
     */
    private $rawNodes;

    /**
     * Store list of Nodes
     *
     * @var Node[]
     */
    private $nodes;

    /**
     * Current element's index
     *
     * @var int
     */
    private $currentIndex = 0;

    /**
     * NodesCollector constructor.
     * @param simple_html_dom_node[] $rawNodes
     */
    public function __construct($rawNodes)
    {
        $this->rawNodes = $rawNodes;
    }

    /**
     * Get the number of nodes
     *
     * @return int
     */
    public function count()
    {
        return count($this->rawNodes);
    }

    /**
     * Return the current element
     *
     * @return Node
     */
    public function current()
    {
        // Ensure current node already transformed
        if (!isset($this->nodes[$this->currentIndex]) && isset($this->rawNodes[$this->currentIndex])) {
            $node = new Node;
            $node->loadSimpleNode($this->rawNodes[$this->currentIndex]);
            $this->nodes[$this->currentIndex] = $node;
        }
        return $this->nodes[$this->currentIndex];
    }

    /**
     * Move forward to next element
     */
    public function next()
    {
        $this->currentIndex++;
    }

    /**
     * Return the key of the current element
     *
     * @return int
     */
    public function key()
    {
        return $this->currentIndex;
    }

    /**
     * Checks if current position is valid
     *
     * @return bool
     */
    public function valid()
    {
        return isset($this->rawNodes[$this->currentIndex]);
    }

    /**
     * Rewind the collector to the first element
     */
    public function rewind()
    {
        $this->currentIndex = 0;
    }
}
