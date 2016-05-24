<?php
require '../vendor/autoload.php';

use \Peec\Bring\API\BookingClient;
use \Peec\Bring\API\Contract\Booking;

// See http://developer.bring.com/api/booking/ ( Authentication section ) . You will need Client id, api key and client url.
$client = new BookingClient("Client_id", "Api_key", "Client_Url");



try {
    $client->bookShipment($request);
} catch (GuzzleHttp\Exception\RequestException $e) {
    throw $e; // 400 responses / error with API key / login to mybring..
} catch (\Peec\Bring\API\DataValidationException $e) {
    throw $e; // just re-throw for testing.
}

