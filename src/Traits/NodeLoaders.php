<?php

namespace SimpleHtmlDom\Traits;

use SimpleHtmlDom\Sources\simple_html_dom;

/**
 * Trait NodeLoaders
 * @package SimpleHtmlDom\Traits
 */
trait NodeLoaders
{
    /**
     * Load node from string
     *
     * @param string $html
     */
    public function load($html)
    {
        $dom = new simple_html_dom();
        $dom->load($html);
        $this->loadSimpleNode($dom->root);
    }

    /**
     * Load node from file
     *
     * @param string $htmlFile
     */
    public function loadFile($htmlFile)
    {
        $dom = new simple_html_dom();
        $dom->load_file($htmlFile);
        $this->loadSimpleNode($dom->root);
    }

    /**
     * Load node from simple_html_dom_node
     *
     * @param object $node \SimpleHtmlDom\Sources\simple_html_dom_node
     */
    abstract public function loadSimpleNode($node);
}
