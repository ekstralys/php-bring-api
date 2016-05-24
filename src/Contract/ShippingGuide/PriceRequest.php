<?php
namespace Peec\Bring\API\Contract\ShippingGuide;

use Peec\Bring\API\ApiEntity;
use Peec\Bring\API\DataValidationException;

class PriceRequest extends ApiEntity
{


    protected $_data = [
        'from' => null,
        'to' => null,
        'weightInGrams' => null,
        'width' => null,
        'length' => null,
        'height' => null,
        'date' => null,
        'time' => null,
        'edi' => null,
        'postingAtPostOffice' => null,
        'additional' => null,
        'priceAdjustments' => null,
        'pid' => null,
        'product' => null,
        'language' => null,
        'volumeSpecial' => null
    ];


    /**
     * From postal code.
     * @param string $from Example: 7600
     * @return $this
     */
    public function setFrom($from) {
        return $this->setData('from', $from);
    }

    /**
     * To postal code.
     * @param string $to Example: 7600
     * @return $this
     */
    public function setTo($to) {
        return $this->setData('to', $to);
    }

    /**
     * Weight of package in grams.
     * @param $weightInGrams Example: 1500
     * @return $this
     */
    public function setWeightInGrams($weightInGrams) {
        return $this->setData('weightInGrams', $weightInGrams);
    }

    /**
     * Package width in centimeters.
     * @param $width
     * @return $this
     */
    public function setWidth ($width) {
        return $this->setData('width', $width);
    }

    /**
     * Package length in centimeters.
     * @param $length
     * @return $this
     */
    public function setLength ($length) {
        return $this->setData('length', $length);
    }

    /**
     * Package height in centimeters.
     * @param $height
     * @return $this
     */
    public function setHeight ($height) {
        return $this->setData('height', $height);
    }

    /**
     * Shipping date. Specifies which date the parcel will be delivered to Bring (within the time limit), and is used to calculate the delivery date.
     * @param \DateTime $dateTime
     * @return $this
     */
    public function setDate (\DateTime $dateTime) {
        return $this->setData('date', $dateTime->format('Y-m-d'));
    }


    /**
     * Shipping time may be specified. Note that Bring’s courier products are the only one affected by this parameter. Time is specified in ISO format, HH:mm.
     * @param \DateTime $dateTime
     * @return $this
     */
    public function setTime (\DateTime $dateTime) {
        return $this->setData('time', $dateTime->format('H:i'));
    }

    public function setEdi($edi) {
        return $this->setData('edi', $edi);
    }

    public function setPostingAtPostOffice($postingAtPostOffice) {
        return $this->setData('postingAtPostOffice', $postingAtPostOffice);
    }

    public function addAdditional($additional) {
        return $this->addData('additional', $additional);
    }

    public function setPriceAdjustments($priceAdjustments) {
        return $this->setData('priceAdjustments', $priceAdjustments);
    }


    public function setPid($pid) {
        return $this->setData('pid', $pid);
    }


    public function addProduct($product) {
        return $this->addData('product', $product);
    }

    public function setLanguage($language) {
        return $this->addData('language', $language);
    }

    public function setVolumeSpecial($volumeSpecial) {
        return $this->setData('volumeSpecial', $volumeSpecial);
    }

    public function validate()
    {

    }
}