<?php

namespace HTMLDomParser\Contracts;

use \Iterator;

/**
 * Interface NodesCollectorContract
 * @package HTMLDomParser\Contracts
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
