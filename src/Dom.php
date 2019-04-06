<?php

namespace SimpleHtmlDom;

use SimpleHtmlDom\Contracts\DomContract;
use SimpleHtmlDom\Sources\simple_html_dom;
use SimpleHtmlDom\Traits\DomCreators;
use SimpleHtmlDom\Traits\DomLoaders;

/**
 * Class Dom
 * @package SimpleHtmlDom
 */
class Dom extends Node implements DomContract
{
    use DomLoaders, DomCreators;

    /**
     * Simple DOM object
     *
     * @var simple_html_dom
     */
    private $dom;

    /**
     * Load DOM from simple_html_dom
     *
     * @param simple_html_dom $dom
     */
    public function loadSimpleDom($dom)
    {
        $this->dom = $dom;
    }

    /**
     * Register the callback function,
     * this function will be invoked while dumping
     *
     * @param callable $callback
     */
    public function setCallback($callback)
    {
        $this->dom->set_callback($callback);
    }

    /**
     * Remove callback function
     */
    public function removeCallback()
    {
        $this->dom->remove_callback();
    }
}
