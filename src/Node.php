<?php

namespace SimpleHtmlDom;

use \simple_html_dom_node;
use SimpleHtmlDom\Collectors\NodesCollector;
use SimpleHtmlDom\Contracts\NodeContract;

/**
 * Class Node
 * @package SimpleHtmlDom
 */
class Node implements NodeContract
{
    /**
     * Store document's node
     *
     * @var simple_html_dom_node
     */
    private $node;

    /**
     * HtmlDomNode constructor.
     * @param simple_html_dom_node $node
     */
    public function __construct($node)
    {
        $this->node = $node;
    }

    /**
     * @param string $selector
     * @param bool $lowercase
     * @return NodeContract[]|NodesCollector|null
     */
    public function find($selector, $lowercase = false)
    {
        $elements = $this->node->find($selector, null, $lowercase);
        if (is_null($elements)) {
            return null;
        }
        return new NodesCollector($elements);
    }

    /**
     * @param string $selector
     * @param bool $lowercase
     * @return NodeContract|null
     */
    public function findOne($selector, $lowercase = false)
    {
        /** @var simple_html_dom_node $element */
        $element = $this->node->find($selector, 0, $lowercase);
        if (is_null($element)) {
            return null;
        }
        return new Node($element);
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->node->text();
    }

    /**
     * @param $name
     * @param $value
     * @return mixed|void
     */
    public function setAttribute($name, $value)
    {
        $this->node->setAttribute($name, $value);
    }
}
