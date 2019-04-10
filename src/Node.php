<?php

namespace SimpleHtmlDom;

use SimpleHtmlDom\Sources\simple_html_dom_node;
use SimpleHtmlDom\Collectors\NodesCollector;
use SimpleHtmlDom\Contracts\NodeContract;
use SimpleHtmlDom\Contracts\NodesCollectorContract;
use SimpleHtmlDom\Traits\NodeCreators;
use SimpleHtmlDom\Traits\NodeLoaders;
use SimpleHtmlDom\Traits\NodeProducers;

/**
 * Class Node
 * @package SimpleHtmlDom
 */
class Node implements NodeContract
{
    use NodeCreators, NodeLoaders, NodeProducers;

    /**
     * Simple dom node object
     *
     * @var simple_html_dom_node
     */
    protected $node;

    /**
     * Load node from simple_html_dom_node object
     *
     * @param simple_html_dom_node|object $node
     */
    public function loadObject($node)
    {
        $this->node = $node;
    }

    /**
     * Get raw node from simple_html_dom
     *
     * @return simple_html_dom_node
     */
    public function getSimpleNode()
    {
        return $this->node;
    }

    /**
     * Get the node's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->node->nodeName();
    }

    /**
     * Get the parent node
     *
     * @return NodeContract|null
     */
    public function getParent()
    {
        return $this->nullOrNode($this->node->parent());
    }

    /**
     * Set the parent node
     *
     * @param NodeContract $parent
     */
    public function setParent($parent)
    {
        $this->node->parent($parent->getSimpleNode());
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
        return $this->nullOrNode($this->node->children($idx));
    }

    /**
     * Get all child nodes
     *
     * @return NodesCollectorContract
     */
    public function getChildren()
    {
        return new NodesCollector($this->node->children(-1));
    }

    /**
     * Get the fist child element
     *
     * @return NodeContract|null
     */
    public function getFirstChild()
    {
        return $this->nullOrNode($this->node->first_child());
    }

    /**
     * Get the last child element
     *
     * @return NodeContract|null
     */
    public function getLastChild()
    {
        return $this->nullOrNode($this->node->last_child());
    }

    /**
     * Get the next sibling node
     *
     * @return NodeContract|null
     */
    public function getNextSibling()
    {
        return $this->nullOrNode($this->node->next_sibling());
    }

    /**
     * Get the previous sibling node
     *
     * @return NodeContract|null
     */
    public function getPrevSibling()
    {
        return $this->nullOrNode($this->node->prev_sibling());
    }

    /**
     * Traverse ancestors to the first matching tag.
     *
     * @param $tag
     * @return NodeContract|null
     */
    public function findAncestorTag($tag)
    {
        return $this->nullOrNode($this->node->find_ancestor_tag($tag));
    }

    /**
     * Find elements by CSS selector
     *
     * @param string $selector
     * @param bool $lowercase
     * @return NodesCollectorContract
     */
    public function find($selector, $lowercase = false)
    {
        return new NodesCollector($this->node->find($selector, null, $lowercase));
    }

    /**
     * Find a element by CSS selector,
     * if current node contains multiple elements with same selector, return the first one
     *
     * @param string $selector
     * @param bool $lowercase
     * @return NodeContract|null
     */
    public function findOne($selector, $lowercase = false)
    {
        return $this->nullOrNode($this->node->find($selector, 0, $lowercase));
    }

    /**
     * Get element by it's ID
     *
     * @param string $id
     * @return NodeContract|null
     */
    public function getElementById($id)
    {
        return $this->nullOrNode($this->node->getElementById($id));
    }

    /**
     * Get a element by tag name,
     * if current node has multiple tags with same name, return the first one
     *
     * @param string $tag
     * @return NodeContract|null
     */
    public function getElementByTagName($tag)
    {
        return $this->findOne($tag);
    }

    /**
     * Get all elements by a tag name
     *
     * @param string $tag
     * @return NodesCollectorContract
     */
    public function getElementsByTagName($tag)
    {
        return $this->find($tag);
    }

    /**
     * Get node's inner text (everything inside the opening and closing tags)
     *
     * @return string
     */
    public function innerHtml()
    {
        return $this->node->innertext();
    }

    /**
     * Get node's xml text (inner text as a CDATA section)
     *
     * @return string
     */
    public function innerXml()
    {
        return $this->node->xmltext();
    }

    /**
     * Get node's outer text (everything including the opening and closing tags)
     *
     * @return string
     */
    public function outerHtml()
    {
        return $this->node->outertext();
    }

    /**
     * Get node's plain text (everything excluding all tags)
     *
     * @return string
     */
    public function text()
    {
        return $this->node->text();
    }

    /**
     * Get a attribute by name
     *
     * @param string $name
     * @return string
     */
    public function getAttribute($name)
    {
        return $this->node->getAttribute($name);
    }

    /**
     * Set attribute for current node
     *
     * @param string $name
     * @param $value
     */
    public function setAttribute($name, $value)
    {
        $this->node->setAttribute($name, $value);
    }

    /**
     * Get all attributes for current node
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->node->getAllAttributes();
    }

    /**
     * Check an attribute exists in current node
     *
     * @param string $name
     * @return bool
     */
    public function hasAttribute($name)
    {
        return $this->node->hasAttribute($name);
    }

    /**
     * Remove an attribute from current node
     *
     * @param string $name
     */
    public function removeAttribute($name)
    {
        $this->node->removeAttribute($name);
    }

    /**
     * Append a node to current node
     *
     * @param NodeContract $node
     */
    public function appendChild($node)
    {
        $this->node->appendChild($node->getSimpleNode());
    }

    /**
     * Build node's text with tag
     *
     * @return string
     */
    public function makeup()
    {
        return $this->node->makeup();
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
     * Convert current node to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->outerHtml();
    }

    /**
     * If element is null, return null
     * else return new Node
     *
     * @param $element
     * @return NodeContract|null
     */
    private function nullOrNode($element)
    {
        if (is_null($element)) {
            return null;
        }
        $node = new Node();
        $node->loadObject($element);
        return $node;
    }
}
