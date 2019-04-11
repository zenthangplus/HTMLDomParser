<?php

namespace HTMLDomParser\Contracts;

/**
 * Interface DomContract
 * @package HTMLDomParser\Contracts
 */
interface DomContract extends NodeContract
{
    /**
     * Register the callback function, this function will be invoked while dumping
     *
     * @param callable $callback Callback function to run for each element
     */
    public function setCallback($callback);

    /**
     * Remove callback function
     */
    public function removeCallback();
}
