<?php
require '../vendor/autoload.php';

use \Peec\Bring\API\BookingClient;
use \Peec\Bring\API\Contract\Booking;

// See http://developer.bring.com/api/booking/ ( Authentication section ) . You will need Client id, api key and client url.
$client = new BookingClient("Client_id", "Api_key", "Client_Url");

$bringTestMode = true; // Setting this to false will send orders to Bring! Careful. This is for testing purposes.

$weight = 2; // 2 kg.
$height = 20;
$length = 20;
$width = 20;

$bringProductId = Booking\BookingRequest\Consignment\Product::PRODUCT_A_POST;
$bringCustomerNumber = 'A-POST-10005540322'; // change with your customer number.


// Send package in 5 hours..
$shipDate = new \DateTime('now');
$shipDate->modify('+5 hours');



// What bring product we want to use for shipping the package(s).

$bringProduct = new Booking\BookingRequest\Consignment\Product();
$bringProduct->setId($bringProductId);
$bringProduct->setCustomerNumber($bringCustomerNumber);

// Create a new package.

$consignmentPackage = new Booking\BookingRequest\Consignment\Package();
$consignmentPackage->setWeightInKg($weight);
$consignmentPackage->setDimensionHeightInCm($height);
$consignmentPackage->setDimensionLengthInCm($length);
$consignmentPackage->setDimensionWidthInCm($width);


// Create a consignment

$consignment = new Booking\BookingRequest\Consignment();
$consignment->addPackage($consignmentPackage);
$consignment->setProduct($bringProduct);
$consignment->setShippingDateTime($shipDate);


// Recipient

$recipient = new Booking\BookingRequest\Consignment\Address();
$recipient->setAddressLine("Veien 32");
$recipient->setCity("Bergen");
$recipient->setCountryCode("NO");
$recipient->setName("Min bedrift");
$recipient->setPostalCode(5097);
$recipient->setReference("KundeID");
$consignment->setRecipient($recipient);


// Sender

$sender = new Booking\BookingRequest\Consignment\Address();
$sender->setAddressLine("Veien 32");
$sender->setCity("Bergen");
$sender->setCountryCode("NO");
$sender->setName("Min bedrift");
$sender->setPostalCode(5097);
$consignment->setSender($sender);







$request = new Booking\BookingRequest();
$request->addConsignment($consignment);
$request->setTestIndicator($bringTestMode);

try {
    $client->bookShipment($request);
} catch (GuzzleHttp\Exception\RequestException $e) {
    throw $e; // 400 responses / error with API key / login to mybring..
} catch (\Peec\Bring\API\DataValidationException $e) {
    throw $e; // just re-throw for testing.
}

