<?php

namespace SimpleHtmlDom\Contracts;

use \Iterator;

/**
 * Interface NodesCollectorContract
 * @package SimpleHtmlDom\Contracts
 */
interface NodesCollectorContract extends Iterator
{
    /**
     * Get the number of nodes
     *
     * @return int
     */
    public function count();
}
