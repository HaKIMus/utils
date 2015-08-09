<?php

namespace PhpDDD\Utils;

use InvalidArgumentException;

trait PopulatePropertiesTrait
{
    /**
     * Fill the properties of the current object with the one specified in the input array.
     *
     * @param array $data
     */
    protected function populate(array $data = array())
    {
        foreach ($data as $propertyName => $value) {
            if (!property_exists($this, $propertyName)) {
                throw new InvalidArgumentException(
                    sprintf(
                        'The class "%s" has no property name "%s"',
                        get_class($this),
                        $propertyName
                    )
                );
            }
            $this->$propertyName = $value;
        }
    }
}
