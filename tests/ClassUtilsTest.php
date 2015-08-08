<?php

namespace PhpDDD\Utils;

use Exception;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 *
 */
final class ClassUtilsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getCanonicalNameProvider
     *
     * @param string|object $class
     * @param string        $expected
     */
    public function testGetCanonicalName($class, $expected)
    {
        $this->assertEquals($expected, ClassUtils::getCanonicalName($class));
    }

    /**
     * @dataProvider getCanonicalNameProviderException
     *
     * @param mixed  $class
     * @param string $parameterType
     */
    public function testGetCanonicalNameException($class, $parameterType)
    {
        try {
            ClassUtils::getCanonicalName($class);
            $this->assertFalse(true, 'An exception should have been thrown.');
        } catch (Exception $exception) {
            $this->assertEquals(
                'The class parameter should be of type string or object, "'.$parameterType.'" given.',
                $exception->getMessage()
            );
        }
    }

    public function getCanonicalNameProvider()
    {
        return [
            [new self(), 'php-ddd__utils__class-utils-test'],
            [new stdClass(), 'std-class'],
            ['MyNamespace\\Sub\\FooBar', 'my-namespace__sub__foo-bar'],
        ];
    }

    public function getCanonicalNameProviderException()
    {
        return [
            [5, 'integer'],
            [5.55, 'double'],
            [[], 'array'],
            [null, 'NULL'],
        ];
    }
}
