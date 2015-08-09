<?php

namespace PhpDDD\Utils\Tests;

use PHPUnit_Framework_TestCase;

/**
 *
 */
final class PopulatePropertiesTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param array $data
     */
    public function testPopulate($data)
    {
        $class = new TestPopulatePropertiesTrait($data);

        $this->assertEquals(isset($data['testPublic']) ? $data['testPublic'] : null, $class->getTestPublic());
        $this->assertEquals(isset($data['testProtected']) ? $data['testProtected'] : null, $class->getTestProtected());
        $this->assertEquals(isset($data['testPrivate']) ? $data['testPrivate'] : null, $class->getTestPrivate());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testPopulateUnknownProperty()
    {
        new TestPopulatePropertiesTrait(array('unknown' => 'test'));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return array(
            array(array()),
            array(array('testPublic'    => 5)),
            array(array('testProtected' => 6)),
            array(array('testPrivate'   => 7)),
            array(array('testPublic'    => 5, 'testProtected' => 6)),
            array(array('testPublic'    => 5, 'testPrivate' => 7)),
            array(array('testProtected' => 6, 'testPrivate' => 7)),
            array(array('testPublic'    => 5, 'testProtected' => 6, 'testPrivate' => 7)),
        );
    }
}
