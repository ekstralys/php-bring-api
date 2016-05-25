<?php
namespace Peec\Bring\API\Client;

use GuzzleHttp\Exception\RequestException;
use Peec\Bring\API\Contract\ShippingGuide\PriceRequest;

class ShippingGuideClient extends Client
{
    const BRING_PRICES_API = 'https://api.bring.com/shippingguide/products/price.json';

    protected $_apiBringPrices = self::BRING_PRICES_API;



    public function getPrices (PriceRequest $request) {
        $query = $request->toArray();

        $url = $this->_apiBringPrices;

        $options = [
            'query' => $this->getQueryParams($query)
        ];

        try {
            $request = $this->request('get', $url, $options);
            $json = json_decode($request->getBody(), true);
            return $json;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $resp = $e->getResponse();
            throw new ShippingGuideClientException("Could not retrieve prices. {$resp->getStatusCode()}): " . $resp->getBody());
        }
    }


    public function setBringPricesApi($api) {
        $this->_apiBringPrices = $api;
        return $this;
    }


}