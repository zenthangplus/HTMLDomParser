<?php

namespace SimpleHtmlDom;

use SimpleHtmlDom\Contracts\DomContract;
use SimpleHtmlDom\Sources\simple_html_dom;
use SimpleHtmlDom\Sources\simple_html_dom_node;
use SimpleHtmlDom\Traits\DomCreators;

/**
 * Class Dom
 * @package SimpleHtmlDom
 */
class Dom extends Node implements DomContract
{
    use DomCreators;

    /**
     * Simple DOM object
     *
     * @var simple_html_dom
     */
    protected $dom;

    /**
     * Dom constructor.
     * @param null|string|object $html
     */
    public function __construct($html = null)
    {
        if ($html) {
            if (is_string($html)) {
                $this->load($html);
            } else {
                $this->loadObject($html);
            }
        }
        parent::__construct(null);
    }

    /**
     * Load DOM from string
     *
     * @param string $html
     */
    public function load($html)
    {
        $dom = $this->newSimpleDom();
        $dom->load($html);
        $this->loadObject($dom);
    }

    /**
     * Load DOM from file
     *
     * @param string $htmlFile
     */
    public function loadFile($htmlFile)
    {
        $dom = $this->newSimpleDom();
        $dom->load_file($htmlFile);
        $this->loadObject($dom);
    }

    /**
     * Load DOM from simple_html_dom
     *
     * @param simple_html_dom|object $dom
     */
    protected function loadObject($dom)
    {
        $this->dom = $dom;
        parent::loadObject($dom->root);
    }

    /**
     * Register the callback function,
     * this function will be invoked while dumping
     *
     * @param callable $callback
     */
    public function setCallback($callback)
    {
        $this->dom->set_callback(function ($element) use ($callback) {
            /** @var simple_html_dom_node $element */
            $node = new Node;
            $node->loadObject($element);
            $callback($node);
        });
    }

    /**
     * Remove callback function
     */
    public function removeCallback()
    {
        $this->dom->remove_callback();
    }
}
