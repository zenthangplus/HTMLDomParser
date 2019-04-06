<?php

namespace SimpleHtmlDom\Traits;

/**
 * Trait NodeProducers
 * @package SimpleHtmlDom\Traits
 */
trait NodeProducers
{
    /**
     * Convert current node to string
     *
     * @return string
     */
    abstract public function __toString();

    /**
     * Save current node to file and get html
     *
     * @param string $filePath
     * @return string
     */
    public function save($filePath = '')
    {
        $html = (string)$this;
        if ($filePath !== '') {
            file_put_contents($filePath, $html, LOCK_EX);
        }
        return $html;
    }
}
