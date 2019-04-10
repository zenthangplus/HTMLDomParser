<?php

namespace SimpleHtmlDom\Traits;

use SimpleHtmlDom\Sources\simple_html_dom;

/**
 * Trait DomLoaders
 * @package SimpleHtmlDom\Traits
 */
trait DomLoaders
{
    /**
     * Load DOM from string
     *
     * @param string $html
     */
    public function load($html)
    {
        $dom = new simple_html_dom();
        $dom->load($html);
        $this->loadSimpleDom($dom);
    }

    /**
     * Load DOM from file
     *
     * @param string $htmlFile
     */
    public function loadFile($htmlFile)
    {
        $dom = new simple_html_dom();
        $dom->load_file($htmlFile);
        $this->loadSimpleDom($dom);
    }

    /**
     * Load DOM from simple_html_dom
     *
     * @param simple_html_dom $dom
     */
    abstract protected function loadSimpleDom($dom);
}
