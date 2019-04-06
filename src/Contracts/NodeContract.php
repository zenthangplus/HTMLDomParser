<?php

namespace SimpleHtmlDom\Contracts;

/**
 * Interface DomNodeContract
 * @package SimpleHtmlDom
 */
interface NodeContract
{
    /**
     * Load node from string
     *
     * @param string $html
     */
    public function loadString($html);

    /**
     * Load node from file
     *
     * @param string $htmlFile
     */
    public function loadFile($htmlFile);

    /**
     * Load node from simple_html_dom_node
     *
     * @param \simple_html_dom_node $node
     */
    public function loadSimpleNode($node);

    /**
     * Save current DOM to file and get html
     *
     * @param string $filePath
     * @return string
     */
    public function save($filePath = '');

    /**
     * Get raw node from simple_html_dom
     *
     * @return \simple_html_dom_node
     */
    public function getSimpleNode();

    /**
     * Get the node's name
     *
     * @return string
     */
    public function getName();

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
     * @return NodesCollectorContract
     */
    public function getChildren();

    /**
     * Get the first child
     *
     * @return NodeContract|null
     */
    public function getFirstChild();

    /**
     * Get the last child
     *
     * @return NodeContract|null
     */
    public function getLastChild();

    /**
     * Get the next sibling node
     *
     * @return NodeContract|null
     */
    public function getNextSibling();

    /**
     * Get previous sibling node
     *
     * @return NodeContract|null
     */
    public function getPrevSibling();

    /**
     * Traverse ancestors to the first matching tag.
     *
     * @param $tag
     * @return NodeContract|null
     */
    public function findAncestorTag($tag);

    /**
     * Find elements by CSS selector
     *
     * @see \simple_html_dom_node::find()
     * @param string $selector
     * @param bool $lowercase
     * @return NodesCollectorContract
     */
    public function find($selector, $lowercase = false);

    /**
     * Find a element by CSS selector,
     * if current node contains multiple elements with same selector, return the first one
     *
     * @see \simple_html_dom_node::find()
     * @param string $selector
     * @param bool $lowercase
     * @return NodeContract|null
     */
    public function findOne($selector, $lowercase = false);

    /**
     * Get element by it's ID
     *
     * @see \simple_html_dom_node::getElementById()
     * @param string $id
     * @return NodeContract|null
     */
    public function getElementById($id);

    /**
     * Get a element by tag name,
     * if current node has multiple tags with same name, return the first one
     *
     * @see \simple_html_dom_node::getElementByTagName()
     * @param string $tag
     * @return NodeContract|null
     */
    public function getElementByTagName($tag);

    /**
     * Get all elements by tag name
     *
     * @see \simple_html_dom_node::getElementsByTagName()
     * @param string $tag
     * @return NodesCollectorContract
     */
    public function getElementsByTagName($tag);

    /**
     * Get node's inner text (everything inside the opening and closing tags)
     *
     * @see \simple_html_dom_node::innertext()
     * @return string
     */
    public function innerHtml();

    /**
     * Get node's xml text (inner text as a CDATA section)
     *
     * @see \simple_html_dom_node::xmltext()
     * @return string
     */
    public function innerXml();

    /**
     * Get node's outer text (everything including the opening and closing tags)
     *
     * @see \simple_html_dom_node::outertext()
     * @return string
     */
    public function outerHtml();

    /**
     * Get node's plain text (everything excluding all tags)
     *
     * @see \simple_html_dom_node::text()
     * @return string
     */
    public function text();

    /**
     * Get a attribute by name
     *
     * @see \simple_html_dom_node::getAttribute()
     * @param string $name
     * @return string
     */
    public function getAttribute($name);

    /**
     * Set attribute for current node
     *
     * @see \simple_html_dom_node::setAttribute()
     * @param string $name
     * @param $value
     */
    public function setAttribute($name, $value);

    /**
     * Get all attributes for current node
     *
     * @see \simple_html_dom_node::getAllAttributes()
     * @return array
     */
    public function getAttributes();

    /**
     * Check an attribute exists in current node
     *
     * @see \simple_html_dom_node::hasAttribute()
     * @param string $name
     * @return bool
     */
    public function hasAttribute($name);

    /**
     * Remove an attribute from current node
     *
     * @see \simple_html_dom_node::removeAttribute()
     * @param string $name
     */
    public function removeAttribute($name);

    /**
     * Append a node to current node
     *
     * @see \simple_html_dom_node::appendChild()
     * @param NodeContract $node
     */
    public function appendChild($node);

    /**
     * Build node's text with tag
     *
     * @see \simple_html_dom_node::makeup()
     * @return string
     */
    public function makeup();

    /**
     * Dump node's tree
     *
     * @param bool $showAttr
     * @param int $deep
     */
    public function dump($showAttr = true, $deep = 0);

    /**
     * Clean up memory due to php5 circular references memory leak
     */
    public function clear();

    /**
     * Convert current node to string
     *
     * @return string
     */
    public function __toString();

    /**
     * Destructor function
     */
    public function __destruct();
}
