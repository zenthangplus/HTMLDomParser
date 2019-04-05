<?php

namespace SimpleHtmlDom;

use \simple_html_dom;

/**
 * Class HtmlDom
 * @package SimpleHtmlDom
 */
class Dom
{
    /**
     * @var simple_html_dom
     */
    private $dom;

    /**
     * HtmlDom constructor.
     * @param simple_html_dom $dom
     */
    public function __construct(simple_html_dom $dom)
    {
        $this->dom = $dom;
    }

    /**
     * Get current node
     *
     * @return Node
     */
    public function getNode()
    {
        return new Node($this->dom->root);
    }

    /**
     * Save document
     *
     * @param string $filepath
     */
    public function save($filepath = '')
    {
        $this->dom->save($filepath);
    }
}
