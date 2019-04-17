<?php

namespace HTMLDomParser\Collectors;

use HTMLDomParser\Node;
use HTMLDomParser\Sources\simple_html_dom_node;
use HTMLDomParser\Contracts\NodesCollectorContract;

/**
 * Class NodesCollector
 * @package HTMLDomParser
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
     * @var \HTMLDomParser\Contracts\NodeContract[]
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
     * @return \HTMLDomParser\Contracts\NodeContract
     */
    public function current()
    {
        // Ensure current node already transformed
        if (!isset($this->nodes[$this->currentIndex]) && isset($this->rawNodes[$this->currentIndex])) {
            $this->nodes[$this->currentIndex] = new Node($this->rawNodes[$this->currentIndex]);
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
