<?php
require '../vendor/autoload.php';

use \Peec\Bring\API\BookingClient;

// See http://developer.bring.com/api/booking/ ( Authentication section ) . You will need Client id, api key and client url.
$client = new BookingClient("Client_id", "Api_key", "Client_Url");

print_r($client->getCustomers());