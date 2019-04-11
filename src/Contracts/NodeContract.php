<?php

namespace HTMLDomParser\Contracts;

/**
 * Interface DomNodeContract
 * @package HTMLDomParser
 */
interface NodeContract
{
    /**
     * Get the node's name
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::nodeName()
     * @return string
     */
    public function getName();

    /**
     * Get the parent node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::parent()
     * @return NodeContract
     */
    public function getParent();

    /**
     * Set the parent node for current node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::parent()
     * @param NodeContract $parent
     */
    public function setParent($parent);

    /**
     * Check the current node has children node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::has_child()
     * @return bool
     */
    public function hasChild();

    /**
     * Get child node by index
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::children()
     * @param int $idx
     * @return null|NodeContract
     */
    public function getChild($idx);

    /**
     * Get all child nodes
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::children()
     * @return NodesCollectorContract
     */
    public function getChildren();

    /**
     * Get the first child
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::firstChild()
     * @return NodeContract|null
     */
    public function getFirstChild();

    /**
     * Get the last child
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::lastChild()
     * @return NodeContract|null
     */
    public function getLastChild();

    /**
     * Get the next sibling node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::nextSibling()
     * @return NodeContract|null
     */
    public function getNextSibling();

    /**
     * Get previous sibling node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::previousSibling()
     * @return NodeContract|null
     */
    public function getPrevSibling();

    /**
     * Traverse ancestors to the first matching tag.
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::find_ancestor_tag()
     * @param $tag
     * @return NodeContract|null
     */
    public function findAncestorTag($tag);

    /**
     * Find elements by CSS selector
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::find()
     * @param string $selector
     * @param bool $lowercase
     * @return NodesCollectorContract
     */
    public function find($selector, $lowercase = false);

    /**
     * Find a element by CSS selector,
     * if current node contains multiple elements with same selector, return the first one
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::find()
     * @param string $selector
     * @param bool $lowercase
     * @return NodeContract|null
     */
    public function findOne($selector, $lowercase = false);

    /**
     * Get element by it's ID
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::getElementById()
     * @param string $id
     * @return NodeContract|null
     */
    public function getElementById($id);

    /**
     * Get a element by tag name,
     * if current node has multiple tags with same name, return the first one
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::getElementByTagName()
     * @param string $tag
     * @return NodeContract|null
     */
    public function getElementByTagName($tag);

    /**
     * Get all elements by tag name
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::getElementsByTagName()
     * @param string $tag
     * @return NodesCollectorContract
     */
    public function getElementsByTagName($tag);

    /**
     * Get node's inner text (everything inside the opening and closing tags)
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::innertext()
     * @return string
     */
    public function innerHtml();

    /**
     * Get node's xml text (inner text as a CDATA section)
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::xmltext()
     * @return string
     */
    public function innerXml();

    /**
     * Get node's outer text (everything including the opening and closing tags)
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::outertext()
     * @return string
     */
    public function outerHtml();

    /**
     * Get node's plain text (everything excluding all tags)
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::text()
     * @return string
     */
    public function text();

    /**
     * Get a attribute by name
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::getAttribute()
     * @param string $name
     * @return string
     */
    public function getAttribute($name);

    /**
     * Set attribute for current node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::setAttribute()
     * @param string $name
     * @param $value
     */
    public function setAttribute($name, $value);

    /**
     * Get all attributes for current node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::getAllAttributes()
     * @return array
     */
    public function getAttributes();

    /**
     * Check an attribute exists in current node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::hasAttribute()
     * @param string $name
     * @return bool
     */
    public function hasAttribute($name);

    /**
     * Remove an attribute from current node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::removeAttribute()
     * @param string $name
     */
    public function removeAttribute($name);

    /**
     * Append a node to current node
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::appendChild()
     * @param NodeContract $node
     */
    public function appendChild($node);

    /**
     * Build node's text with tag
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::makeup()
     * @return string
     */
    public function makeup();

    /**
     * Dump node's tree
     *
     * @see \HTMLDomParser\Sources\simple_html_dom_node::dump()
     * @param bool $showAttr
     * @param int $deep
     */
    public function dump($showAttr = true, $deep = 0);

    /**
     * Save current DOM to file and get html
     *
     * @see \HTMLDomParser\Sources\simple_html_dom::save()
     * @param string $filePath
     * @return string
     */
    public function save($filePath = '');

    /**
     * Convert current node to string
     *
     * @return string
     */
    public function __toString();

    /**
     * Get raw node from simple_html_dom
     *
     * @return \HTMLDomParser\Sources\simple_html_dom_node
     */
    public function getSimpleNode();
}
