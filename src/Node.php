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
    protected $node;

    /**
     * HtmlDomNode constructor.
     * @param simple_html_dom_node $node
     */
    public function __construct($node)
    {
        $this->node = $node;
    }

    /**
     * HtmlDomNode destructor
     */
    function __destruct()
    {
        $this->clear();
    }

    /**
     * Convert current node to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->node->outertext();
    }

    /**
     * Clean up memory due to php5 circular references memory leak...
     */
    public function clear()
    {
        $this->node->clear();
    }

    /**
     * Dump node's tree
     *
     * @param bool $showAttr
     * @param int $deep
     */
    public function dump($showAttr = true, $deep = 0)
    {
        $this->node->dump($showAttr, $deep);
    }

    /**
     * Get the parent node
     *
     * @return NodeContract|null
     */
    public function getParent()
    {
        /** @var simple_html_dom_node $parent */
        $parent = $this->node->parent();
        if (is_null($parent)) {
            return null;
        }
        return new Node($parent);
    }

    /**
     * Set the parent node
     *
     * @param NodeContract $parent
     */
    public function setParent($parent)
    {
        $this->node->parent($parent->getRaw());
    }

    /**
     * Check the current node has child node
     *
     * @return bool
     */
    public function hasChild()
    {
        return $this->node->has_child();
    }

    /**
     * Get child node by index
     *
     * @param int $idx
     * @return NodeContract|null
     */
    public function getChild($idx)
    {
        if ($idx < 0) {
            return null;
        }
        /** @var simple_html_dom_node $child */
        $child = $this->node->children($idx);
        if (is_null($child)) {
            return null;
        }
        return new Node($child);
    }

    /**
     * Get all child nodes
     *
     * @return NodesCollector
     */
    public function getChildren()
    {
        $children = $this->node->children(-1);
        return new NodesCollector($children);
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

    /**
     * Get raw not from simple_html_dom
     *
     * @return simple_html_dom_node
     */
    public function getRaw()
    {
        return $this->node;
    }
}
