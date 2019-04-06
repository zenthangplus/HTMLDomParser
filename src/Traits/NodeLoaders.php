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
     * Load node from simple_html_dom_node
     *
     * @param \SimpleHtmlDom\Sources\simple_html_dom_node $node
     */
    abstract public function loadSimpleNode($node);

    /**
     * Load node from string
     *
     * @param string $html
     */
    public function loadString($html)
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
}
