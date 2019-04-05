<?php

namespace SimpleHtmlDom\Contracts;

/**
 * Interface DomNodeContract
 * @package SimpleHtmlDom
 */
interface NodeContract
{
    /**
     * Destructor function
     */
    public function __destruct();

    /**
     * Convert current node to string
     *
     * @return string
     */
    public function __toString();

    /**
     * Clean up memory due to php5 circular references memory leak
     */
    public function clear();

    /**
     * Dump node's tree
     *
     * @param bool $showAttr
     * @param int $deep
     */
    public function dump($showAttr = true, $deep = 0);

    /**
     * Get the parent node
     *
     * @return NodeContract
     */
    public function getParent();

    /**
     * Set the parent node for current node
     *
     * @param NodeContract $parent
     */
    public function setParent($parent);

    /**
     * Check the current node has children node
     *
     * @return bool
     */
    public function hasChild();

    /**
     * Get child node by index
     *
     * @param int $idx
     * @return null|NodeContract
     */
    public function getChild($idx);

    /**
     * Get all child nodes
     *
     * @return NodeContract[]
     */
    public function getChildren();

    /**
     * @param string $selector
     * @param bool $lowercase
     * @return NodeContract[]
     */
    public function find($selector, $lowercase = false);

    /**
     * @param string $selector
     * @param bool $lowercase
     * @return NodeContract
     */
    public function findOne($selector, $lowercase = false);

    /**
     * @return string
     */
    public function text();

    /**
     * Set attribute for current node
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public function setAttribute($name, $value);

    /**
     * Get raw node from simple_html_dom
     *
     * @return \simple_html_dom_node
     */
    public function getRaw();
}
