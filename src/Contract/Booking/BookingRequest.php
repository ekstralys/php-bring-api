<?php
namespace Peec\Bring\API\Contract\Booking;

use Peec\Bring\API\ApiEntity;
use Peec\Bring\API\DataValidationException;

class BookingRequest extends ApiEntity
{

    const SCHEMA_VERSION = 1;

    protected $_data = [
        'testIndicator' => true,
        'schemaVersion' => self::SCHEMA_VERSION,
        'consignments' => []
    ];


    public function setTestIndicator ($testIndicator) {
        return $this->setData('testIndicator', $testIndicator);
    }

    public function addConsignment(BookingRequest\Consignment $consignment) {
        return $this->addData('consignments', $consignment);
    }
    public function validate()
    {
        if (!$this->getData('consignments')) {
            throw new DataValidationException('BookingRequest requires at least one of "consignments".');
        }
    }
}