<?php

namespace HTMLDomParser\Contracts;

use \Iterator;

/**
 * Interface NodesCollectorContract
 * @package HTMLDomParser\Contracts
 */
interface NodesCollectorContract extends Iterator, \Countable
{
    /**
     * Get the number of nodes
     * @link https://php.net/manual/en/countable.count.php
     *
     * @return int
     */
    public function count();

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     *
     * @return NodeContract
     */
    public function current();
}
