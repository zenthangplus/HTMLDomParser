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
     * @param string $methodName
     * @param array $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeMethod(&$object, $methodName, $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Call static method of a class
     *
     * @param $className
     * @param $methodName
     * @param array $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeStaticMethod($className, $methodName, $parameters = array())
    {
        $reflection = new \ReflectionClass($className);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($reflection, $parameters);
    }

    /**
     * Get invisible property value of a class
     *
     * @param $object
     * @param string $propertyName
     * @return mixed
     * @throws \ReflectionException
     */
    public function getInvisibleProperty(&$object, $propertyName)
    {
        $reflection = new \ReflectionClass(get_class($object));
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }
}
