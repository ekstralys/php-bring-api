<?php

namespace Peec\Bring\API;


class DataValidationException extends \Exception
{

    protected $_fields = [];

    public function addField ($field) {
        $this->_fields[] = $field;
    }

    public function getFields() {
        return $this->_fields;
    }

}