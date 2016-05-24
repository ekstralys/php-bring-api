<?php
namespace Peec\Bring\API;


/**
 * Class ApiEntity
 *
 * @package Peec\Bring\API
 */
abstract class ApiEntity
{

    /**
     * Can be modified with the respective data functions.
     * @var array Data for the entity.
     */
    protected $_data = [];

    /**
     * Sets data by key and value.
     * @param $key Identifier
     * @param $value The value
     * @return $this
     */
    protected function setData($key, $value) {
        $this->_data[$key] = $value;
        return $this;
    }

    /**
     * Gets data based on key
     * @param $key The identifier.
     * @return mixed
     */
    protected function getData($key) {
        return $this->_data[$key];
    }

    /**
     * Adds data to data array
     * @param $key Identifier.
     * @param $value Value to add
     * @return $this
     */
    protected function addData($key, $value) {
        if (!isset($this->_data[$key]) || !is_array($this->_data[$key])) {
            $this->_data[$key] = [];
        }
        $this->_data[$key][] = $value;
        return $this;
    }

    /**
     * Checks if data contains given identifier.
     * @param $key
     * @return bool
     */
    protected function containsData($key) {
        return isset($this->_data[$key]);
    }

    /**
     * Validates this entity. Throws exception if errors.
     * @return mixed
     * @throws DataValidationException
     */
    abstract public function validate();


    /**
     * Validates and runs data validations recursively.
     * @return array Serialized array
     */
    public function toArray () {
        $this->validate();
        return $this->dataToArray($this->_data);
    }

    /**
     * Recursively serialize data and ApiEntity instances.
     * @param array $data Array of data
     * @return array Serialized array
     */
    protected function dataToArray (array $data) {
        $result = [];
        foreach ($data as $key => $value) {
            if ($value instanceof ApiEntity) {
                $result[$key] = $value->toArray();
            } else if (is_array($value)) {
                $result[$key] = $this->dataToArray($value);
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

}