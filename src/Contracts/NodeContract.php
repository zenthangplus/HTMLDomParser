<?php

namespace SimpleHtmlDom\Contracts;

/**
 * Interface DomNodeContract
 * @package SimpleHtmlDom
 */
interface NodeContract
{
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
}
