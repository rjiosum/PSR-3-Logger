<?php declare(strict_types=1);
namespace Tests;

require_once dirname(__DIR__).'/bootstrap/boot.php';

use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;

abstract class TestCase extends BaseTestCase
{
    public function getPrivateMethod($className, $methodName)
    {
        $reflector = new ReflectionClass($className);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }

    public function getPrivateProperty($className, $propertyName)
    {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);
        return $property;
    }
}