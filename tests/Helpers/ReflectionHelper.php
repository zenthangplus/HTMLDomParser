<?php

namespace HTMLDomParserTests\Helpers;

/**
 * Trait ReflectionHelper
 * @package HTMLDomParserTests\Helpers
 */
trait ReflectionHelper
{
    /**
     * Call protected/private method of a class.
     *
     * @param $object
     * @param $methodName
     * @param array $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
