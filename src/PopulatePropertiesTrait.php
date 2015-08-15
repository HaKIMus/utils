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
    protected function populate(array $data = [])
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

    /**
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        $data       = [];
        $properties = get_object_vars($this);
        foreach ($properties as $propertyName => $value) {
            $data[$propertyName] = serialize($value);
        }

        return serialize($data);
    }

    /**
     * @param string $serialized The string representation of the object.
     *
     * @return void
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        foreach ($data as $propertyName => $value) {
            $this->$propertyName = unserialize($value);
        }
    }
}
